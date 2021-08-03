<?php
session_start();
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('superadmins');
if ($_POST['action'] == 'changepassword') {
    $_POST['sa_password'] =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_POST['sa_id'] = $_SESSION['id'];
    unset($_POST['action'], $_POST['password']);
    $abc = $rr->save($_POST, 'sa_id');
}
