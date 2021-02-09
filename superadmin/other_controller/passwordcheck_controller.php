<?php
session_start();
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('superadmins');
$ad_id = $_SESSION['id'];
$dat = $rr->find('sa_id', $ad_id);
$data = $dat->fetch();
$password = $_POST['password'];
$hashedpassword = $data['sa_password'];
if (password_verify($password, $hashedpassword)) {
    echo 'true';
} else {
    echo 'false';
}
