<?php
session_start();
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('admins');
$a_id = $_SESSION['id'];
$dat = $rr->find('a_id', $a_id);
$data = $dat->fetch();
$password = $_POST['password'];
$hashedpassword = $data['a_password'];
if (password_verify($password, $hashedpassword)) {
    echo 'true';
} else {
    echo 'false';
}
