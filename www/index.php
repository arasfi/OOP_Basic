<?php

require 'vendor/autoload.php';

use App\Database\Connection as Connection;
use App\Database\TableInsert as TableInsert;
use App\Database\StockDB as StockDB;

// try {
//     // connect to the PostgreSQL database
//     $pdo = Connection::get()->connect();
//     // 
//     $insertDemo = new TableInsert($pdo);

//     // insert a stock into the stocks table
//     $id = $insertDemo->insertStock('MSFT', 'Microsoft Corporation');
//     echo 'The stock has been inserted with the id ' . $id . '<br>';

//     // insert a list of stocks into the stocks table
//     $list = $insertDemo->insertStockList([
//         ['symbol' => 'GOOG', 'company' => 'Google Inc.'],
//         ['symbol' => 'YHOO', 'company' => 'Yahoo! Inc.'],
//         ['symbol' => 'FB', 'company' => 'Facebook, Inc.'],
//     ]);

//     foreach ($list as $id) {
//         echo 'The stock has been inserted with the id ' . $id . '<br>';
//     }
// } catch (\PDOException $e) {
//     echo $e->getMessage();
// }


// try {
//     // connect to the PostgreSQL database
//     $pdo = Connection::get()->connect();

//     // 
//     $updateDemo = new TableUpdate($pdo);

//     // insert a stock into the stocks table
//     $affectedRows = $updateDemo->updateStock(2, 'GOOGL', 'Alphabet Inc.');

//     echo 'Number of row affected ' . $affectedRows;
// } catch (\PDOException $e) {
//     echo $e->getMessage();
// }

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $stockDB = new StockDB($pdo);
    // get all stocks data
    $stocks = $stockDB->all();
} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PostgreSQL PHP Querying Data Demo</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Stock List</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Symbol</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stocks as $stock) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($stock['id']) ?></td>
                            <td><?php echo htmlspecialchars($stock['symbol']); ?></td>
                            <td><?php echo htmlspecialchars($stock['company']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php

// $stock = $stockDB->findByPK(1);    
// var_dump($stock);

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();

    $accountDB = new StockDB($pdo);

    // add accounts
    $accountDB->addAccount('John', 'Doe', 4, date('Y-m-d'));
    $accountDB->addAccount('Linda', 'Williams', 5, date('Y-m-d'));
    $accountDB->addAccount('Maria', 'Miller', 6, date('Y-m-d'));


    echo 'The new accounts have been added.' . '<br>';
    // 
    //$accountDB->addAccount('Susan', 'Wilson', 99, date('Y-m-d'));
} catch (\PDOException $e) {
    echo $e->getMessage();
}