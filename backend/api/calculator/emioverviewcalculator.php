<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
include '../libs/connect.php';
include '../../../classes/databasetable.php';
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

                //work area

                if (isset($_POST['l_id'])) {
                    $tab1 = new DatabaseTable('loans');
                    $dat = $tab1->find('l_id', $_POST['l_id']);
                    $d1 = $dat->fetch();
                    $_POST['interest'] = '12';
                    $_POST['principal'] = $d1['l_amount'];
                    $_POST['years'] = $d1['l_period'] / 12;
                    $_POST['start_date'] = date('Y-m-d', strtotime($d1['l_upload_date_time']));
                    $_POST['l_downpayment'] = $d1['l_down_payment'];
                }
                $arr1 = [];
                $rate = $_POST['interest'] / 100;
                $principle = $_POST['principal'];
                $time = $_POST['years'] * 12; // in month
                $period = $time;
                $downpayment = $_POST['l_downpayment'];
                $x = pow(1 + $rate, $time);
                //echo $x;
                $monthly = ($principle * $x * $rate) / ($x - 1);
                $monthly = round($monthly);
                $k = $time;
                $arr = [];
                function getNextMonth2($date)
                {
                    global $arr;
                    global $k;
                    if ($k == 0) {
                        return 0;
                    }
                    $date = new DateTime($date);
                    $interval = new DateInterval('P1M');
                    $date->add($interval);
                    $nextMonth = $date->format('Y-m-d') . "\n";
                    $arr[] = $nextMonth;
                    $k--;
                    return getNextMonth2($nextMonth);
                }

                getNextMonth2($_POST['start_date']);
                // simple chart display here
                $date = "";
                $upto = $time;
                $i = 0;
                $totalint = 0;
                $payment_date = date("Y m,d");
                $tp = 0;
                function getEmi($t)
                {
                    global $i, $upto, $pdo, $totalint, $rate, $monthly, $payment_date, $arr, $_SESSION, $tp, $ar, $arr1, $count, $principle, $downpayment, $period;
                    $i++;
                    if ($upto <= 0) {
                        return 0;
                    }
                    $p = (($principle - $downpayment) / $period);
                    $r = $p * $rate;
                    $e = round($t - $p);

                    $totalint = $totalint + $r;
                    $tp = $tp + $monthly;
                    $upto--;
                    $arrDate1 = explode('-', $arr[$i - 1]);
                    $data1 =  date("M j, Y", mktime(0, 0, 0, $arrDate1[1], $arrDate1[2], $arrDate1[0]));
                    $data2 =  number_format(($r));
                    $data3 = number_format($t);
                    $data4 = number_format($p);
                    $data5 = number_format($monthly);
                    $data6 = number_format(round($e));
                    $tod = $arrDate1[1] - 1;
                    //calculate collection monthly
                    $dateObj   = DateTime::createFromFormat('!m', $tod);
                    $monthName = $dateObj->format('F'); // March
                    $tmc = $pdo->prepare("SELECT SUM(lt_principal) FROM loan_transactions WHERE monthname(lt_uploaddate) = :date && lt_l_id=:lid");
                    $tmc->execute(['date' => $monthName, 'lid' => $_POST['l_id']]);
                    $tmc2 = $tmc->fetchAll();
                    $monthlycollected = $tmc2[0];

                    $count++;
                    $ar = [
                        'counter' => $count,
                        'date' => $data1,
                        'monthlycollected' => $monthlycollected[0],
                        'targetcollection' => $data4
                    ];
                    array_push($arr1, $ar);
                    return getEmi($e);
                }
                getEmi($_POST['principal'] - $_POST['l_downpayment']);
                echo json_encode(array("status" => true, "data" => $arr1));
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
