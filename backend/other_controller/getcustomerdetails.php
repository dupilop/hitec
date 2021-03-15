<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

if (isset($_POST['action']) && $_POST['action'] == 'getcustomer') {
    $abc = $pdo->prepare("SELECT * FROM customers WHERE c_id=:id");
    $abc->execute(['id' => $_POST['id']]);
    $abc2 = $abc->fetchAll();
    echo json_encode($abc2);
}
