<?php
if (!isset($_SESSION['id'])) {
	header('Location: ../login.php');
}
$abc = new DatabaseTable('advances');
if (isset($_POST['update'])) {
	unset($_POST['update']);

	$ins = $abc->save($_POST, 'adv_id');
	header('Location: advancepayment');
}
$title = 'Advance Payment';
$content = loadTemplate('templates/advancepayment_template.php', []);
