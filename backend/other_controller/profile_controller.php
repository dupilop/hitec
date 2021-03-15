<?php
session_start();
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('admins');
if ($_POST['action'] == 'changepassword') {
    $_POST['a_password'] =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_POST['a_id'] = $_SESSION['id'];
    unset($_POST['action'], $_POST['password']);
    $abc = $rr->save($_POST, 'a_id');
}
