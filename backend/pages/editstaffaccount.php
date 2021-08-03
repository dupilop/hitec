<?php
$abc = new DatabaseTable('admins');
$abc2 = new DatabaseTable('roles_assign');
if (isset($_POST['update'])) {
	$ras_parent_id = $_POST['ras_parent_id'];
	unset($_POST['update'], $_POST['ras_parent_id']);
	$ins = $abc->update($_POST, 'a_id');
	$criteria = [
		'ras_parent_id' => $ras_parent_id,
		'ras_a_id' => $_POST['a_id']
	];
	$ins2 = $abc2->update($criteria, 'ras_a_id');

	// print_r($_POST);
	header('Location: viewstaffaccount');
}
$a_id = $_GET['a_id'];
$dat = $pdo->prepare("SELECT * FROM admins a 
INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='staff' AND a.a_id=:aid");
$dat->execute(['rname' => 'superadmin', 'aid' => $a_id]);
$a = $dat->fetch();
$title = 'Update Staff';
$content = loadTemplate('templates/editstaffaccount_template.php', ['a' => $a]);
