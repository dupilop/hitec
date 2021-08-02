<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
session_start();
$abc = new DatabaseTable('loans');
if (isset($_POST['action']) && $_POST['action'] == 'settle') {
    $_POST['l_status'] = 'paid';
    unset($_POST['action']);
    $_POST['l_settledby'] = $_SESSION['id'];
    $up1 = $abc->update($_POST, 'l_id');
}
