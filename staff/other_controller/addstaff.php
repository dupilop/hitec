<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

$abc = new DatabaseTable('admins');
$abc2 = new DatabaseTable('roles_assign');
$ras_uploadedby = $_POST['ras_a_id'];
unset($_POST['ras_a_id']);
$ins = $abc->insert($_POST);
$ras_a_id = $pdo->lastInsertId();
$criteria = [
    'ras_a_id' => $ras_a_id,
    'ras_r_id' => '3',
    'ras_uploadedon' => date("Y-m-d H:i:s"),
    'ras_uploadedby' => $ras_uploadedby
];
$ins2 = $abc2->insert($criteria);
print_r($_POST);
