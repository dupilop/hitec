<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
if (isset($_POST['action']) && $_POST['action'] == 'chkcitizen') { //chkcitizenforup
    $abc = $pdo->prepare("SELECT * FROM customers WHERE c_citizenship_number=:c_citizenship_number");
    $abc->execute(['c_citizenship_number' => $_POST['citichk']]);
    $rabc = $abc->rowCount();
    if ($rabc > 0) {
        echo false;
    } else {
        echo true;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'chkcitizenforup') {
    $abc = $pdo->prepare("SELECT * FROM customers WHERE c_citizenship_number=:c_citizenship_number");
    $abc->execute(['c_citizenship_number' => $_POST['citichk']]);
    $rabc = $abc->rowCount();
    if ($_POST['oldcitinum'] == $_POST['citichk']) {
        echo true;
    } else {
        if ($rabc > 0) {
            echo false;
        } else {
            echo true;
        }
    }
}
