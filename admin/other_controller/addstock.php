<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

$abc = new DatabaseTable('stocks');
$ins = $abc->insert($_POST);
print_r($_POST);
