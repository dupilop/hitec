<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

$abc = new DatabaseTable('loans');
if (isset($_POST['action']) && $_POST['action'] == 'settle') {
    $_POST['l_status'] = 'paid';
    unset($_POST['action']);
    $up1 = $abc->update($_POST, 'l_id');
}
