<?php
$abc = new DatabaseTable('loans');
if(isset($_POST['update'])){
	unset($_POST['update']);
	$_POST['l_remaining_loan'] = $_POST['l_amount'];
	$_POST['l_status'] = 'unpaid';
	$_POST['l_month'] = date('m');
	$_POST['l_year'] = date('Y');
	$ins = $abc->insert($_POST);
	header('location: emiloanentry');
}
	$title = 'EMI-Loan Entry';
	$content = loadTemplate('../templates/emiloanentry_template.php', []);
?>