<?php 
$did = $_GET['ms_id'];
$abc = new DatabaseTable('masiksavings');
$abc2 = new DatabaseTable('customers');
$dat = $abc->find('ms_id', $did)->fetch();
$cid = $dat['c_id'];
$cat = $abc2->find('c_id', $cid)->fetch();
$savedamount = $dat['ms_amount'];
$ms_withdraw_amount = $dat['ms_withdraw_amount'];
$rollbackamount = $cat['c_total_saving_amount'] - $savedamount + $ms_withdraw_amount;

$c1 = [
	'c_total_saving_amount' => $rollbackamount,
	'c_id' => $cid
];

$up1 = $abc2->update($c1, 'c_id');
$del1 = $abc->delete('ms_id', $did);
header('Location: masiksavingscheckup');

?>