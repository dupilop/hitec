<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
session_start();
$abc = new DatabaseTable('admins');
$abc2 = new DatabaseTable('roles_assign');
$abc3 = new DatabaseTable('permissions');
$pass = password_hash($_POST['a_password'], PASSWORD_DEFAULT);
$_POST['a_password'] = $pass;
$ins = $abc->insert($_POST);
$ras_uploadedby = $_POST['ras_a_id'];
unset($_POST['ras_a_id']);
$ras_a_id = $pdo->lastInsertId();
$criteria = [
    'ras_a_id' => $ras_a_id,
    'ras_r_id' => '2',
    'ras_parent_id' => $ras_uploadedby,
    'ras_uploadedby' => $_SESSION['id']
];
$ins2 = $abc2->insert($criteria);
$criteria2 = [
    'p_a_id' => $ras_a_id,
    'p_uploadedby' => $_SESSION['id']
];
$ins3 = $abc3->insert($criteria2);
print_r($_POST);
