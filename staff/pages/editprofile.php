<?php
$abc = new DatabaseTable('staffs');

if(isset($_POST['update'])){
	

	if(!$_FILES['s_new_profile_image']['name'] == ''){
		$_POST['s_profile_image'] = $_FILES['s_new_profile_image']['name'];
	}
	 if ($_FILES['s_new_profile_image']['error'] == 0) {
     $fileName = $_FILES['s_new_profile_image']['name'];
      move_uploaded_file($_FILES['s_new_profile_image']['tmp_name'], '../../images/profile/' . $fileName);
    }
	unset($_POST['update'], $_POST['s_new_profile_image']);
	$ins = $abc->update($_POST, 's_id');
	header('location: profile');
}
$abc = $pdo->query("SELECT * FROM staffs WHERE s_id=".$_SESSION['id'])->fetch();

	$title = 'Edit Profile';
	$content = loadTemplate('../templates/editprofile_template.php', ['abc' => $abc]);
?>