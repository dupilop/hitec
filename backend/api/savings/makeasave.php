<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
include '../libs/connect.php';
include '../libs/messageapi.php';
// include '../../../classes/databasetable.php';
require '../authentication/tokenverify.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
                $abc = new DatabaseTable('masiksavings');
                $abc2 = new DatabaseTable('customers');


                $_POST['ms_month'] = date("m");
                $_POST['ms_year'] = date("Y");
                $totalsaving = $_POST['c_total_saving_amount'];
                $_POST['ms_uploadedby'] = $data1['a_id'];
                unset($_POST['pay'], $_POST['c_total_saving_amount']);
                $ins = $abc->insert($_POST);

                $criteria = [
                    'c_total_saving_amount' => $totalsaving,
                    'c_id' => $_POST['c_id']
                ];
                $cus1 = $abc2->find('c_id', $_POST['c_id']);
                $cus2 = $cus1->fetch();
                $ins = $abc2->update($criteria, 'c_id');
                $send_res = sendmessage('3b83171c6652431626034ba629539855a8edb93d49b058738367a07956978dda', $cus2['c_mobile'], "Your saving has been done. Now your total saving is Rs. " . $totalsaving);
                echo json_encode(array("status" => true, "message" => 'Savings Done Successfully'));
                die();

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
