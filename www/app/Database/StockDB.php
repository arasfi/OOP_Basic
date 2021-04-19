<?php

namespace App\Database;
/**
 * Create table in PostgreSQL from PHP demo
 */
class StockDB {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * init the object with a \PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * create tables 
     */
     /**
     * Return all rows in the stocks table
     * @return array
     */
    public function all() {
        $stmt = $this->pdo->query('SELECT id, symbol, company '
                . 'FROM stocks '
                . 'ORDER BY symbol');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'id' => $row['id'],
                'symbol' => $row['symbol'],
                'company' => $row['company']
            ];
        }
        return $stocks;
    }
    /**
     * Find stock by id
     * @param int $id
     * @return a stock object
     */
    public function findByPK($id) {
        // prepare SELECT statement
        $stmt = $this->pdo->prepare('SELECT id, symbol, company
                                       FROM stocks
                                      WHERE id = :id');
        // bind value to the :id parameter
        $stmt->bindValue(':id', $id);
        
        // execute the statement
        $stmt->execute();

        // return the result set as an object
        return $stmt->fetchObject();
    }
/**
     * 
     * @param string $firstName
     * @param string $lastName
     * @return int
     */
    private function insertAccount($firstName, $lastName) {
        $stmt = $this->pdo->prepare(
                'INSERT INTO accounts(first_name,last_name) '
                . 'VALUES(:first_name,:last_name)');

        $stmt->execute([
            ':first_name' => $firstName,
            ':last_name' => $lastName
        ]);

        return $this->pdo->lastInsertId('accounts_id_seq');
    }

    /**
     * insert a new plan for an account
     * @param int $accountId
     * @param int $planId
     * @param int $effectiveDate
     * @return bool
     */
    private function insertPlan($accountId, $planId, $effectiveDate) {
        $stmt = $this->pdo->prepare(
                'INSERT INTO account_plans(account_id,plan_id,effective_date) '
                . 'VALUES(:account_id,:plan_id,:effective_date)');

        return $stmt->execute([
                    ':account_id' => $accountId,
                    ':plan_id' => $planId,
                    ':effective_date' => $effectiveDate,
        ]);
    }
    /**
     * Add a new account
     * @param string $firstName
     * @param string $lastName
     * @param int $planId
     * @param date $effectiveDate
     */
    public function addAccount($firstName, $lastName, $planId, $effectiveDate) {
        try {
            // start the transaction
            $this->pdo->beginTransaction();

            // insert an account and get the ID back
            $accountId = $this->insertAccount($firstName, $lastName);

            // add plan for the account
            $this->insertPlan($accountId, $planId, $effectiveDate);

            // commit the changes
            $this->pdo->commit();
        } catch (\PDOException $e) {
            // rollback the changes
            $this->pdo->rollBack();
            throw $e;
        }
    }
  
}