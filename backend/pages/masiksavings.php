
<?php
$abc = new DatabaseTable('masiksavings');
$abc2 = new DatabaseTable('customers');
if (isset($_POST['pay'])) {

	$_POST['ms_month'] = date("m");
	$_POST['ms_year'] = date("Y");
	$_POST['ms_dateupload'] = date("Y-m-d H:i:sa");
	$totalsaving = $_POST['c_total_saving_amount'];
	$_POST['ms_uploadedby'] = $_SESSION['id'];
	unset($_POST['pay'], $_POST['c_total_saving_amount']);
	$ins = $abc->insert($_POST);

	$criteria = [
		'c_total_saving_amount' => $totalsaving,
		'c_id' => $_POST['c_id']
	];
	$ins = $abc2->save($criteria, 'c_id');
	header('Location: masiksavings');
}
$title = 'Invoice-Masik Savings';
$content = loadTemplate('templates/masiksavings_template.php', []);
?>