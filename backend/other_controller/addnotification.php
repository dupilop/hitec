<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

$abc = new DatabaseTable('notifications');
$_POST['n_date'] = date("Y-m-d h:i:sa");
$_POST['n_visibility'] = 'yes';
$ins = $abc->insert($_POST);
print_r($_POST);
