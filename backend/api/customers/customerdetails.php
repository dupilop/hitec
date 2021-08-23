<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
include '../libs/connect.php';
// include '../../../classes/databasetable.php';
require '../authentication/tokenverify.php';
header('content-type: application/json');
date_default_timezone_set("Asia/Kathmandu");
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    session_start();
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
                //working area
                $shid = $_GET['c_id'];
                //     $dat2 = $pdo->query("SELECT * FROM customers c 
                //   WHERE c.c_id ='$shid'")->fetch(PDO::FETCH_ASSOC);
                $lonn = $pdo->prepare("SELECT * FROM customers c 
              LEFT JOIN loans l on c.c_id = l.l_c_id
              WHERE c.c_id ='$shid'");
                $lonn->execute();
                $lon = $lonn->fetch(PDO::FETCH_ASSOC);

                $rcount = $lonn->rowCount();
                if ($rcount > 0) {

                    echo json_encode(array("status" => true, "data" => $lon));
                    die();
                } else {
                    echo json_encode(array("status" => false, "message" => 'No data added', "data" => $dat2));
                    die();
                }
                //work end
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
