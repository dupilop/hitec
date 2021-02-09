<?php
$abc = new DatabaseTable('customers');

if(isset($_POST['update'])){
	unset($_POST['update']);
	$ins = $abc->update($_POST, 'c_id');
	header('location: viewcustomer');
}
$abc = $pdo->query("SELECT * FROM customers WHERE c_id=".$_GET['id'])->fetch();

	$title = 'Edit Customer';
	$content = loadTemplate('templates/editcustomer_template.php', ['abc' => $abc]);
