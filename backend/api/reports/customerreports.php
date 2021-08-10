<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../libs/connect.php';
// include '../../../classes/databasetable.php';
include '../authentication/tokenverify.php';
include_once '../config.php';

header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        if (isset($_SERVER['HTTP_TOKEN']))
            $token = $_SERVER['HTTP_TOKEN'];
        else {
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
                $arr = [];

                if ($data3['r_name'] == 'superadmin') {
                    $asd = $pdo->prepare("SELECT * FROM customers");
                    $asd->execute();
                    foreach ($asd as $asd2) {
                        $date1 = date_create($asd2['c_created_on']);
                        array_push($arr, [
                            'registeredon' => date_format($date1, "Y-m-d"),
                            'cname' => $asd2['c_name'],
                            'cnumber' => $asd2['c_number'],
                            'photo' => ($asd2['c_photo'] != '' || $asd2['c_photo'] != null) ? $customerimageurl . $asd2['c_photo'] : $customernoimage,
                            'mobile' => $asd2['c_mobile'],
                            'gender' => $asd2['c_gender'],
                            'address' => $asd2['c_permanent_address'],
                            'email' => $asd2['c_email'],
                            'office' => $asd2['c_office'],
                            'dob' => $asd2['c_dob'],
                            'occupation' => $asd2['c_occupation'],
                            'cid' => $asd2['c_id']
                        ]);
                    }
                } else if ($data3['r_name'] == 'admin') {
                    $asd = $pdo->prepare("SELECT * FROM customers c
                    INNER JOIN admins a ON a.a_id=c.c_created_by 
                  INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby || ra.ras_parent_id=:upby");
                    $asd->execute(['cby' => $data1['a_id'], 'upby' =>  $data1['a_id']]);
                    foreach ($asd as $asd2) {
                        $date1 = date_create($asd2['c_created_on']);
                        array_push($arr, [
                            'registeredon' => date_format($date1, "Y-m-d"),
                            'cname' => $asd2['c_name'],
                            'cnumber' => $asd2['c_number'],
                            'photo' => ($asd2['c_photo'] != '' || $asd2['c_photo'] != null) ? $customerimageurl . $asd2['c_photo'] : $customernoimage,
                            'mobile' => $asd2['c_mobile'],
                            'gender' => $asd2['c_gender'],
                            'address' => $asd2['c_permanent_address'],
                            'email' => $asd2['c_email'],
                            'office' => $asd2['c_office'],
                            'dob' => $asd2['c_dob'],
                            'occupation' => $asd2['c_occupation'],
                        ]);
                    }
                } else if ($data3['r_name'] == 'staff') {
                    $asd = $pdo->prepare("SELECT * FROM customers c
                    INNER JOIN admins a ON a.a_id=c.c_created_by 
                  INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby");
                    $asd->execute(['cby' => $data1['a_id']]);
                    foreach ($asd as $asd2) {
                        $date1 = date_create($asd2['c_created_on']);
                        array_push($arr, [
                            'registeredon' => date_format($date1, "Y-m-d"),
                            'cname' => $asd2['c_name'],
                            'cnumber' => $asd2['c_number'],
                            'photo' => ($asd2['c_photo'] != '' || $asd2['c_photo'] != null) ? $customerimageurl . $asd2['c_photo'] : $customernoimage,
                            'mobile' => $asd2['c_mobile'],
                            'gender' => $asd2['c_gender'],
                            'address' => $asd2['c_permanent_address'],
                            'email' => $asd2['c_email'],
                            'office' => $asd2['c_office'],
                            'dob' => $asd2['c_dob'],
                            'occupation' => $asd2['c_occupation'],
                        ]);
                    }
                } else {
                    echo json_encode(array("status" => false, "message" => 'You are currently not authorized. Please make a valid login'));
                    die();
                }
                echo json_encode(array("status" => true, "data" => $arr));
                die();
            } else {
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
    } catch (PDOException $e) {
        echo json_encode(array(
            "success" => false,
            "message" => "Oops! There is a technical error, please try again later.",
            "errorlog" => $e
        ));
        die();
    }
}
