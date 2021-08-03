<?php 
$did = $_GET['cbid'];
$abc = new DatabaseTable('loan_transactions');
$abc2 = new DatabaseTable('loans');
$dat = $abc->find('lt_id', $did)->fetch();
$principal = $dat['lt_principal'];
$lid = $dat['lt_l_id'];
$dat2 = $abc2->find('l_id', $lid)->fetch();
$remloan = $dat2['l_remaining_loan'];
$rollbackamount = $remloan + $principal;

$c1 = [
	'l_remaining_loan' => $rollbackamount,
	'l_id' => $lid
];

$up1 = $abc2->update($c1, 'l_id');
$del1 = $abc->delete('lt_id', $did);
header('Location: paymentrollback');

?>