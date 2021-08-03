<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
include '../../db/connect.php';
include '../../classes/databasetable.php';
header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['l_id'])) {
        $tab1 = new DatabaseTable('loans');
        $dat = $tab1->find('l_id', $_POST['l_id']);
        $d1 = $dat->fetch();
        $_POST['interest'] = '12';
        $_POST['principal'] = $d1['l_amount'];
        $_POST['years'] = $d1['l_period'] / 12;
        $_POST['start_date'] = date('Y-m-d', strtotime($d1['l_upload_date_time']));
    }
    $arr1 = [];
    $rate = $_POST['interest'] / 100 / 12;
    $principle = $_POST['principal'];
    $time = $_POST['years'] * 12; // in month
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
        global $i, $upto, $totalint, $rate, $monthly, $payment_date, $arr, $_SESSION, $tp, $ar, $arr1, $count;
        $i++;
        if ($upto <= 0) {
            return 0;
        }
        $r = $t * $rate;
        $p = round($monthly - $r);
        $e = round($t - $p);
        if ($upto == 2) {
            $_SESSION['tl'] = $e;
        }
        if ($upto == 1) {
            $p = $_SESSION['tl'];
            $e = round($t - $p);
            $monthly = round($p + $r);
        }
        $totalint = $totalint + $r;
        $tp = $tp + $monthly;
        $upto--;
        $arrDate1 = explode('-', $arr[$i - 1]);
        $data1 =  date("M j, Y", mktime(0, 0, 0, $arrDate1[1], $arrDate1[2], $arrDate1[0]));
        $data2 =  number_format(round($r));
        $data3 = number_format($t);
        $data4 = number_format($p);
        $data5 = number_format($monthly);
        $data6 = number_format(round($e));
        $count++;
        $ar = [
            'counter' => $count,
            'date' => $data1,
            'interest' => $data2,
            'bbalance' => $data3,
            'principle' => $data4,
            'tpayment' => $data5,
            'ebalance' => $data6
        ];
        array_push($arr1, $ar);
        return getEmi($e);
    }
    getEmi($_POST['principal']);
    echo json_encode(array("status" => true, "data" => $arr1));
    die();


    // } else {
    //     echo json_encode(array("status" => false, "note" => 'data error'));
    // }
}
