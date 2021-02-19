<?php
session_start();
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
print_r($_POST);
if (isset($_FILES)) {
  $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
  $img1 = $_FILES['c_photo']['name'];
  $img2 = $_FILES['c_front_citizenship']['name'];
  $img3 = $_FILES['c_back_citizenship']['name'];
  $ext1 = strtolower(pathinfo($img1, PATHINFO_EXTENSION));
  $ext2 = strtolower(pathinfo($img2, PATHINFO_EXTENSION));
  $ext3 = strtolower(pathinfo($img3, PATHINFO_EXTENSION));
  $final_image1 = rand(1000, 1000000) . $img1;
  $final_image2 = rand(1000, 1000000) . $img2;
  $final_image3 = rand(1000, 1000000) . $img3;
  if (in_array($ext1, $valid_extensions)) {
    $path1 = strtolower($final_image1);
  }
  if (in_array($ext2, $valid_extensions)) {
    $path2 = strtolower($final_image2);
  }
  if (in_array($ext3, $valid_extensions)) {
    $path3 = strtolower($final_image3);
  }
  if ($_FILES['c_photo']['error'] == 0) {
    $_POST['c_photo'] = $path1;
    move_uploaded_file($_FILES['c_photo']['tmp_name'], '../../images/customers/' . $path1);
  }
  if ($_FILES['c_front_citizenship']['error'] == 0) {
    $_POST['c_front_citizenship'] = $path2;
    move_uploaded_file($_FILES['c_front_citizenship']['tmp_name'], '../../images/customers/' . $path2);
  }
  if ($_FILES['c_back_citizenship']['error'] == 0) {
    $_POST['c_back_citizenship'] = $path3;
    move_uploaded_file($_FILES['c_back_citizenship']['tmp_name'], '../../images/customers/' . $path3);
  }
}
$_POST['c_uploadedby'] = $_SESSION['id'];
$abc = new DatabaseTable('customers');
$ins = $abc->insert($_POST);
// print_r($_POST);
