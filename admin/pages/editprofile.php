<?php
$abc = new DatabaseTable('superadmins');

if (isset($_POST['update'])) {


	if (!$_FILES['sa_new_profile_image']['name'] == '') {
		$_POST['sa_profile_image'] = $_FILES['sa_new_profile_image']['name'];
	}
	if ($_FILES['sa_new_profile_image']['error'] == 0) {
		$fileName = $_FILES['sa_new_profile_image']['name'];
		move_uploaded_file($_FILES['sa_new_profile_image']['tmp_name'], '../images/profile/' . $fileName);
	}
	unset($_POST['update'], $_POST['sa_new_profile_image']);
	$ins = $abc->update($_POST, 'sa_id');
	header('location: profile');
}
$abc = $pdo->query("SELECT * FROM superadmins WHERE sa_id=" . $_SESSION['id'])->fetch();

$title = 'Edit Customer';
$content = loadTemplate('templates/editprofile_template.php', ['abc' => $abc]);
