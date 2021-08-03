<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';
$abc = new DatabaseTable('customers');

if (isset($_POST['action'])) {
    unset($_POST['action']);
    print_r($_POST);
    if (isset($_FILES)) {
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
        $img1 = $_FILES['c_photo']['name'];
        $img2 = $_FILES['c_front_citizenship']['name'];
        $img3 = $_FILES['c_back_citizenship']['name'];
        $img4 = $_FILES['c_checkimage']['name'];
        $img5 = $_FILES['c_bankstatement']['name'];
        $ext1 = strtolower(pathinfo($img1, PATHINFO_EXTENSION));
        $ext2 = strtolower(pathinfo($img2, PATHINFO_EXTENSION));
        $ext3 = strtolower(pathinfo($img3, PATHINFO_EXTENSION));
        $ext4 = strtolower(pathinfo($img4, PATHINFO_EXTENSION));
        $ext5 = strtolower(pathinfo($img5, PATHINFO_EXTENSION));
        $final_image1 = rand(1000, 1000000) . $img1;
        $final_image2 = rand(1000, 1000000) . $img2;
        $final_image3 = rand(1000, 1000000) . $img3;
        $final_image4 = rand(1000, 1000000) . $img4;
        $final_image5 = rand(1000, 1000000) . $img5;
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
        if ($_FILES['c_checkimage']['error'] == 0) {
            $_POST['c_checkimage'] = $final_image4;
            move_uploaded_file($_FILES['c_checkimage']['tmp_name'], '../../images/customers/' . $final_image4);
        }
        if ($_FILES['c_bankstatement']['error'] == 0) {
            $_POST['c_bankstatement'] = $final_image5;
            move_uploaded_file($_FILES['c_bankstatement']['tmp_name'], '../../images/customers/' . $final_image5);
        }
    }
    $ins = $abc->save($_POST, 'c_id');
}
