<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
// include '../../../classes/databasetable.php';
include '../libs/connect.php';
include './tokenverify.php';
require '../libs/messageapi.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $_POST = json_decode(file_get_contents("php://input"));
    date_default_timezone_set("Asia/Kathmandu");
    $data = $_POST;

    $tab1 = new DatabaseTable('admins');
    $tab2 = new DatabaseTable('roles_assign');
    $tab3 = new DatabaseTable('roles');
    $tab4 = new DatabaseTable('iplogs');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (isset($_SERVER['HTTP_TOKEN'])) {
        $token = $_SERVER['HTTP_TOKEN'];
        if (tokenverify($token)) {
            $findd1 = $tab1->find('a_token', $token);
            $dataa1 = $findd1->fetch();
            $findd2 = $tab4->find('adId', $dataa1['a_id']);
            $dataa2 = $findd2->fetch();
            $rcdataa2 = $findd2->rowCount();
            if ($rcdataa2 > 0) {
                if ($dataa2['iptoken'] == $data['otpcode']) {
                    $toupdate1 = [
                        'optokenStatus' => 1,
                        'iplId' => $dataa2['iplId']
                    ];
                    $update11 = $tab4->update($toupdate1, 'iplId');
                    echo json_encode(array("status" => true, "message" => 'Login Successful'));
                    die();
                } else {
                    echo json_encode(array("status" => false, "message" => 'OTP didnot matched', 'data' => $data['otpcode'], "errtype" => 'otpmode'));
                    die();
                }
            } else {
                echo json_encode(array("status" => false, "message" => 'OTP didnot matched', 'data' => $data['otpcode'], "errtype" => 'otpmode'));
                die();
            }
        }
    } else {
        $email = $data['email'];
        $password = $data['password'];
        $find1 = $tab1->find('a_email', $email);
        $data1 = $find1->fetch();
        $counter = $find1->rowCount();
        if ($counter > 0) {
            if (password_verify($password, $data1['a_password'])) {
                if ($data1['a_active'] == 0) {
                    echo json_encode(array("status" => false, "message" => 'TAKE A NAP. ITS YOUR REST TIME', "errtype" => 'sleepingmode'));
                    die();
                } else {
                    if (tokenverify($data1['a_token'])) {
                        $find4 = $pdo->prepare("SELECT * FROM iplogs WHERE ip=:ip && adId=:adId");
                        $find4->execute(['ip' => $ip, 'adId' => $data1['a_id']]);
                        $data4 = $find4->fetch();
                        $dataCount = $find4->rowCount();

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
                        if ($dataCount > 0 && $data4['optokenStatus'] == 1) {

                            session_start();
                            $_SESSION['access_level'] = $data3['r_name'];
                            $_SESSION['superadminloggedin'] = true;
                            $_SESSION['id'] = $data1['a_id'];
                            echo json_encode(array("status" => true, "message" => 'Login Successful', "data" => $response, "ip" => $ip, "otp" => false));
                            die();
                        } else {
                            $otpcode = random_int(100000, 999999);

                            $today = date('Y-m-d H:i:s');
                            $currentDate = strtotime($today);
                            $futureDate = $currentDate + (60 * 60 * 24);
                            $formatDate = date("Y-m-d H:i:s", $futureDate);
                            $tosave1 = [
                                'adId' => $data1['a_id'],
                                'ip' => $ip,
                                'iptoken' => $otpcode,
                                'iptoken_expiry' => $formatDate
                            ];
                            if ($dataCount > 0) {
                                $inss1 = $tab4->update($tosave1, 'adId');
                            } else {
                                $inss1 = $tab4->insert($tosave1);
                            }
                            $send_res = sendmessage('3b83171c6652431626034ba629539855a8edb93d49b058738367a07956978dda', '9841996490', "Your otp code is: " . $otpcode);
                            echo json_encode(array("status" => false, "message" => 'New Login Detected', "ip" => $ip, "data" => $response, "otp" => true, "errtype" => 'newloginmode'));
                            die();
                        }
                    } else if (expirytokenverify($data1['a_token'])) {
                        $find4 = $pdo->prepare("SELECT * FROM iplogs WHERE ip=:ip && adId=:adId");
                        $find4->execute(['ip' => $ip, 'adId' => $data1['a_id']]);
                        $data4 = $find4->fetch();
                        $dataCount = $find4->rowCount();
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
                        if ($dataCount > 0 && $data4['optokenStatus'] == 1) {

                            session_start();
                            $_SESSION['access_level'] = $data3['r_name'];
                            $_SESSION['superadminloggedin'] = true;
                            $_SESSION['id'] = $data1['a_id'];
                            echo json_encode(array("status" => true, "message" => 'Login Successful', "data" => $response, "otp" => false));
                            die();
                        } else {
                            $otpcode = random_int(100000, 999999);
                            $today = date('Y-m-d H:i:s');
                            $currentDate = strtotime($today);
                            $futureDate = $currentDate + (60 * 60 * 24);
                            $formatDate = date("Y-m-d H:i:s", $futureDate);
                            $tosave1 = [
                                'adId' => $data1['a_id'],
                                'ip' => $ip,
                                'iptoken' => $otpcode,
                                'iptoken_expiry' => $formatDate
                            ];
                            if ($dataCount > 0) {
                                $inss1 = $tab4->update($tosave1, 'adId');
                            } else {
                                $inss1 = $tab4->insert($tosave1);
                            }
                            $send_res = sendmessage('3b83171c6652431626034ba629539855a8edb93d49b058738367a07956978dda', '9841996490', "Your otp code is: " . $otpcode);
                            echo json_encode(array("status" => false, "message" => 'New Login Detected', "ip" => $ip, "data" => $response, "otp" => true, "errtype" => 'newloginmode'));
                            die();
                        }
                    } else if ($data1['a_token'] == '') {
                        newinitialtoken($data1['a_id']);
                        echo json_encode(array("status" => true, "message" => 'Please Login Again your are registered into our system. Thank You'));
                        die();
                    } else {
                        echo json_encode(array("status" => false, "message" => 'Token Mismatched', "errtype" => 'tokenmode'));
                        die();
                    }
                }
            } else {
                echo json_encode(array("status" => false, "message" => 'Password didnot matched', "errtype" => 'crediantialsmode'));
                die();
            }
        } else {
            echo json_encode(array("status" => false, "message" => 'Invalid Email', "errtype" => 'crediantialsmode'));
            die();
        }
    }
}
