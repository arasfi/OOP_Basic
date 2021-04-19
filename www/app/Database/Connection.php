<?php
namespace App\Database;

/**
 * Represent the Connection
 */
class Connection {

    private $servername = "172.23.0.2";
    private $username = "user";
    private $password = "user";
    private $dbname = "teststage";
    private $port = 5432;

    /**
     * Connection
     * @var type 
     */
    private static $conn;

    /**
     * Connect to the database and return an instance of \PDO object
     * @return \PDO
     * @throws \Exception
     */
    public function connect() {

        

        // connect to the postgresql database
        $conStr = "pgsql:host=$this->servername;port=$this->port;dbname=$this->dbname;user=$this->username;password=$this->password";

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get() 
    {
        if (static::$conn === null)
            static::$conn = new static();
        return static::$conn;
    }

    protected function __construct() {
        
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}