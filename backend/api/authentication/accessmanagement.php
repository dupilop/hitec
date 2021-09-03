<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../libs/connect.php';
// include '../../../classes/databasetable.php';
include './tokenverify.php';

header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
                //workarea

                $arr = [
                    'a_id' => $_POST['id'],
                    'a_active' => $_POST['a_active']
                ];
                $up1 = $tab1->update($arr,'a_id');
                
                echo json_encode(array("status" => true, "message"=>"Updated Successfully", "data" => $arr));
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
