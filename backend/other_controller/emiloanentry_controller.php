<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
session_start();
$abc = new DatabaseTable('loans');
if ($_POST['action'] == 'addloan') {
	$_POST['l_remaining_loan'] = $_POST['l_amount'] - $_POST['l_down_payment'];
	$_POST['l_status'] = 'unpaid';
	$_POST['l_month'] = date('m');
	$_POST['l_year'] = date('Y');
	$_POST['l_uploadedby'] = $_SESSION['id'];
	unset($_POST['action']);
	$ins = $abc->insert($_POST);
}
