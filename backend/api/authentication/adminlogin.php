<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
// include '../../../classes/databasetable.php';
include '../libs/connect.php';
include './tokenverify.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $_POST = json_decode(file_get_contents("php://input"));
    date_default_timezone_set("Asia/Kathmandu");
    $data = $_POST;

    $email = $data['email'];
    $password = $data['password'];
    $tab1 = new DatabaseTable('admins');
    $tab2 = new DatabaseTable('roles_assign');
    $tab3 = new DatabaseTable('roles');
    $find1 = $tab1->find('a_email', $email);
    $data1 = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {
        if (password_verify($password, $data1['a_password'])) {

            if (tokenverify($data1['a_token'])) {

                $find2 = $tab2->find('ras_a_id', $data1['a_id']);
                $data2 = $find2->fetch();
                $find3 = $tab3->find('r_id', $data2['ras_r_id']);
                $data3 = $find3->fetch();
                $response = [
                    'a_token' => $data1['a_token'],
                    'a_email' => $data1['a_email'],
                    'a_fullname' => $data1['a_fullname'],
                    'a_position' => $data1['a_position'],
                    'a_department' => $data1['a_department'],
                    'role' => $data3['r_name']
                ];
                session_start();
                $_SESSION['access_level'] = $data3['r_name'];
                $_SESSION['superadminloggedin'] = true;
                $_SESSION['id'] = $data1['a_id'];
                echo json_encode(array("status" => true, "message" => 'Login Successful', "data" => $response));
                die();
            } else if (expirytokenverify($data1['a_token'])) {
                $find11 = $tab1->find('a_email', $email);
                $data11 = $find11->fetch();
                $find2 = $tab2->find('ras_a_id', $data1['a_id']);
                $data2 = $find2->fetch();
                $find3 = $tab3->find('r_id', $data2['ras_r_id']);
                $data3 = $find3->fetch();
                $response = [
                    'a_token' => $data11['a_token'],
                    'a_email' => $data11['a_email'],
                    'a_fullname' => $data11['a_fullname'],
                    'a_position' => $data11['a_position'],
                    'a_department' => $data11['a_department'],
                    'role' => $data3['r_name']
                ];
                session_start();
                $_SESSION['access_level'] = $data3['r_name'];
                $_SESSION['superadminloggedin'] = true;
                $_SESSION['id'] = $data1['a_id'];
                echo json_encode(array("status" => true, "message" => 'Login Successful', "data" => $response));
                die();
            } else if ($data1['a_token'] == '') {
                newinitialtoken($data1['a_id']);
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
