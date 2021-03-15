<?php
$abc = new DatabaseTable('admins');

if (isset($_POST['update'])) {


	if (!$_FILES['a_new_profile_image']['name'] == '') {
		$_POST['a_profile_image'] = $_FILES['a_new_profile_image']['name'];
	}
	if ($_FILES['a_new_profile_image']['error'] == 0) {
		$fileName = $_FILES['a_new_profile_image']['name'];
		move_uploaded_file($_FILES['a_new_profile_image']['tmp_name'], '../images/profile/' . $fileName);
	}
	unset($_POST['update'], $_POST['a_new_profile_image']);
	$ins = $abc->update($_POST, 'a_id');
	header('location: profile');
}
if (!isset($_SESSION['id'])) {
	header('Location: ../login.php');
}
$abc = $pdo->query("SELECT * FROM admins WHERE a_id=" . $_SESSION['id'])->fetch();

$title = 'Edit Customer';
$content = loadTemplate('templates/editprofile_template.php', ['abc' => $abc]);
