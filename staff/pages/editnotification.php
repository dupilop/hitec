
<?php
$abc = new DatabaseTable('notifications');
if (isset($_POST['update'])) {
	unset($_POST['update']);
	$ins = $abc->update($_POST, 'n_id');
	// print_r($_POST);
	header('Location: notification');
}
$n_id = $_GET['n_id'];
$dat = $pdo->query("SELECT * FROM notifications WHERE n_id=" . $n_id);
$a = $dat->fetch();
$title = 'Update Notifications';
$content = loadTemplate('templates/editnotification_template.php', ['a' => $a]);
?>