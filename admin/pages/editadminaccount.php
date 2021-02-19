<?php
$abc = new DatabaseTable('admins');
if(isset($_POST['update'])){
	unset($_POST['update']);
$ins = $abc->update($_POST, 'a_id');
// print_r($_POST);
header('Location: viewadminaccount');	
}
$a_id = $_GET['a_id'];
$dat = $pdo->query("SELECT * FROM admins WHERE a_id=".$a_id);
$a = $dat->fetch();
	$title = 'Update Admin';
	$content = loadTemplate('templates/editadminaccount_template.php', ['a' => $a]);
