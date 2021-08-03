<?php
$abc = new DatabaseTable('stocks');
if(isset($_POST['update'])){
	unset($_POST['update']);
$ins = $abc->update($_POST, 'st_id');
// print_r($_POST);
header('Location: stocks');	
}
$st_id = $_GET['st_id'];
$dat = $pdo->query("SELECT * FROM stocks WHERE st_id=".$st_id);
$a = $dat->fetch();
	$title = 'Update Stock';
	$content = loadTemplate('templates/editstock_template.php', ['a' => $a]);
