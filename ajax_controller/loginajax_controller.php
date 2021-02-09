<?php
session_start();
require '../db/connect.php';
$access_level = '';


if (($_POST['action'] == 'login')) {
  $email = $_POST['email'];
  $sql = "SELECT * FROM superadmins WHERE sa_email='$email'";
  $chk = $pdo->prepare($sql);
  $chk->execute();
  $val = $chk->fetch();
  $total_row = $chk->rowCount();

  $sql2 = "SELECT * FROM admins WHERE a_email='$email'";
  $chk2 = $pdo->prepare($sql2);
  $chk2->execute();
  $val2 = $chk2->fetch();
  $total_row2 = $chk2->rowCount();

  $sql3 = "SELECT * FROM staffs WHERE s_email='$email'";
  $chk3 = $pdo->prepare($sql3);
  $chk3->execute();
  $val3 = $chk3->fetch();
  $total_row3 = $chk3->rowCount();

  if ($total_row > 0) {
    if (password_verify($_POST['password'], $val['sa_password'])) {
      $access_level = 'superadmin';
      $_SESSION['sadminloggedin'] = true;
      $_SESSION['id'] = $val['sa_id'];
    }
  } else if ($total_row2 > 0) {
    if (password_verify($_POST['password'], $val2['a_password'])) {
      $access_level = 'admin';
      $_SESSION['adminloggedin'] = true;
      $_SESSION['id'] = $val2['a_id'];
    }
  } else if ($total_row3 > 0) {
    if (password_verify($_POST['password'], $val3['s_password'])) {
      $access_level = 'staff';
      $_SESSION['staffloggedin'] = true;
      $_SESSION['id'] = $val3['s_id'];
      $_SESSION['creator_id'] = $val3['s_a_id'];
    }
  }
  echo $access_level;
}
