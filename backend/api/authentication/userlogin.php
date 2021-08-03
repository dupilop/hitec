<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
// include '../../../classes/databasetable.php';
include '../libs/connect.php';
include './usertokenverify.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $_POST = json_decode(file_get_contents("php://input"));
    $data = $_POST;

    $mobile = $data['mobile'];
    $password = $data['password'];
    $tab1 = new DatabaseTable('customers');
    $find1 = $tab1->find('c_mobile', $mobile);
    $data1 = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {
        if (password_verify($password, $data1['c_password'])) {

            if (tokenverify($data1['c_token'])) {
                $response = [
                    'c_token' => $data1['c_token'],
                    'c_email' => $data1['c_email'],
                    'c_name' => $data1['c_name'],
                    'c_number' => $data1['c_number'],
                    'c_occupation' => $data1['c_occupation'],
                    'c_mobile' => $data1['c_mobile'],
                    'c_dob' => $data1['c_dob'],
                    'c_office' => $data1['c_office'],
                    'c_photo' => $data1['c_photo']

                ];
                session_start();
                $_SESSION['access_level'] = 'customers';
                $_SESSION['userloggedin'] = true;
                $_SESSION['id'] = $data1['c_id'];
                echo json_encode(array("status" => true, "message" => 'Customer Login Successful', "data" => $response));
                die();
            } else if (expirytokenverify($data1['c_token'])) {
                $find11 = $tab1->find('c_email', $email);
                $data11 = $find11->fetch();

                $response = [
                    'c_token' => $data11['c_token'],
                    'c_email' => $data11['c_email'],
                    'c_name' => $data11['c_name'],
                    'c_number' => $data11['c_number'],
                    'c_occupation' => $data11['c_occupation'],
                    'c_mobile' => $data11['c_mobile'],
                    'c_dob' => $data11['c_dob'],
                    'c_office' => $data11['c_office'],
                    'c_photo' => $data11['c_photo']
                ];
                session_start();
                $_SESSION['access_level'] = 'customers';
                $_SESSION['userloggedin'] = true;
                $_SESSION['id'] = $data1['c_id'];
                echo json_encode(array("status" => true, "message" => 'Customer Login Successful', "data" => $response));
                die();
            } else if ($data1['c_token'] == '') {
                newinitialtoken($data1['c_id']);
                echo json_encode(array("status" => true, "message" => 'Please Login Again your are registered into our system. Thank You'));
                die();
            } else {
                echo json_encode(array("status" => false, "message" => 'Token Mismatched'));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => 'Password didnot matched'));
            die();
        }
    } else {
        echo json_encode(array("status" => false, "message" => 'Invalid Email'));
        die();
    }
}
