<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
include '../libs/connect.php';
// include '../../../classes/databasetable.php';
require '../authentication/tokenverify.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    try {
        if (isset($_SERVER['HTTP_TOKEN']))
            $token = $_SERVER['HTTP_TOKEN'];
        else
        {
        echo json_encode(array("status" => false, "message" => 'Invalid Token'));
        die();
        }
        $tab1 = new DatabaseTable('admins');
        $tab2 = new DatabaseTable('roles_assign');
        $tab3 = new DatabaseTable('roles');
        $find1 = $tab1->find('a_token', $token);
        $data1 = $find1->fetch();
        $counter = $find1->rowCount();
        if ($counter > 0) {
            $find2 = $tab2->find('ras_a_id', $data1['a_id']);
            $data2 = $find2->fetch();
            $find3 = $tab3->find('r_id', $data2['ras_r_id']);
            $data3 = $find3->fetch();

            if (tokenverify($data1['a_token'])) {
    if (isset($_POST['c_citizenship_number'])) {
        $citizencheck = $pdo->prepare("SELECT * FROM customers WHERE c_citizenship_number=:cnum");
        $citizencheck->execute(['cnum' => $_POST['c_citizenship_number']]);
        $rcheck = $citizencheck->rowCount();
        if ($rcheck > 0) {
            echo json_encode(array("status" => false, "message" => 'Citizenship Number already exists'));
            die();
        } else {

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
                    move_uploaded_file($_FILES['c_photo']['tmp_name'], '../images/customers/' . $path1);
                }
                if ($_FILES['c_front_citizenship']['error'] == 0) {
                    $_POST['c_front_citizenship'] = $path2;
                    move_uploaded_file($_FILES['c_front_citizenship']['tmp_name'], '../images/customers/' . $path2);
                }
                if ($_FILES['c_back_citizenship']['error'] == 0) {
                    $_POST['c_back_citizenship'] = $path3;
                    move_uploaded_file($_FILES['c_back_citizenship']['tmp_name'], '../images/customers/' . $path3);
                }
                if ($_FILES['c_checkimage']['error'] == 0) {
                    $_POST['c_checkimage'] = $final_image4;
                    move_uploaded_file($_FILES['c_checkimage']['tmp_name'], '../images/customers/' . $final_image4);
                }
                if ($_FILES['c_bankstatement']['error'] == 0) {
                    $_POST['c_bankstatement'] = $final_image5;
                    move_uploaded_file($_FILES['c_bankstatement']['tmp_name'], '../images/customers/' . $final_image5);
                }
            }
            $_POST['c_uploadedby'] = $data1['a_id'];
            $abc = new DatabaseTable('customers');
            $ins = $abc->insert($_POST);
            echo json_encode(array("status" => true, "message" => 'Customer Added Successfully'));
            die();
        }
    } else {
        echo json_encode(array("status" => false, "message" => 'Citizenship Number cannot be null'));
        die();
    }
}
else {
    session_start();
    session_destroy();
    $_SESSION['superadminloggedin'] = false;
    echo json_encode(array("status" => false, "message" => 'Token Expired', "loggedin" => false));
    die();
}
} else {
echo json_encode(array("status" => false, "message" => 'Invalid Token'));
die();
}

}catch (PDOException $e) {
    echo json_encode(array(
        "success" => false,
        "message" => "Oops! There is a technical error, please try again later.",
        "errorlog" => $e
    ));
    die();
}
}

