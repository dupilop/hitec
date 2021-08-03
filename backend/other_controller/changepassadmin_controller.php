<?php
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('admins');
if ($_POST['action'] == 'changeadminpassword') {
    $_POST['a_password'] =  password_hash($_POST['a_password'], PASSWORD_DEFAULT);
    unset($_POST['action']);
    $abc = $rr->save($_POST, 'a_id');
}
