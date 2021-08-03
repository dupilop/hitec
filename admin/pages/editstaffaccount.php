<?php
$abc = new DatabaseTable('staffs');
if(isset($_POST['update'])){
	unset($_POST['update']);
$ins = $abc->update($_POST, 's_id');
// print_r($_POST);
header('Location: viewstaffaccount');	
}
$s_id = $_GET['s_id'];
$dat = $pdo->query("SELECT * FROM staffs WHERE s_id=".$s_id);
$a = $dat->fetch();
	$title = 'Update Staff';
	$content = loadTemplate('templates/editstaffaccount_template.php', ['a' => $a]);
