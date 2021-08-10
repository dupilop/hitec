<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';

$abc = new DatabaseTable('stocks');
if (isset($_FILES)) {
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
    $img1 = $_FILES['st_image']['name'];

    $ext1 = strtolower(pathinfo($img1, PATHINFO_EXTENSION));

    $final_image1 = rand(1000, 1000000) . $img1;

    if (in_array($ext1, $valid_extensions)) {
        $path1 = strtolower($final_image1);
    }

    if ($_FILES['st_image']['error'] == 0) {
        $_POST['st_image'] = $path1;
        move_uploaded_file($_FILES['st_image']['tmp_name'], '../api/images/stocks/' . $path1);
    }
}
$ins = $abc->insert($_POST);
print_r($_POST);
