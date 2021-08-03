<?php
session_start();
require '../db/connect.php';
$access_level = '';


if (($_POST['action'] == 'login')) {
  $email = $_POST['email'];

  $sql2 = "SELECT * FROM admins a 
  INNER JOIN roles_assign raa ON a.a_id=raa.ras_a_id 
  INNER JOIN roles r ON r.r_id=raa.ras_r_id WHERE a_email='$email'";
  $chk2 = $pdo->prepare($sql2);
  $chk2->execute();
  $val2 = $chk2->fetch();
  $total_row = $chk2->rowCount();

  if ($total_row > 0) {
    if (password_verify($_POST['password'], $val2['a_password'])) {
      $access_level = $val2['r_name'];
      $_SESSION['access_level'] = $access_level;
      $_SESSION['superadminloggedin'] = true;
      $_SESSION['id'] = $val2['a_id'];
    }
  }
  echo $access_level;
}else{
    echo 'Error';
}
