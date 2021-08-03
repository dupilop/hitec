<?php
error_reporting(0);
if (isset($_POST)) {
    $_POST['years'] = $_POST['months'] / 12;
    $rate = $_POST['interest'] / 100 / 12;
    $principle = $_POST['principal'];
    $time = $_POST['years'] * 12; // in month
    $x = pow(1 + $rate, $time);

    // $monthly = round($monthly);
    $k = $time;
    $arr = array();
    function getNextMonth($date)
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
        return getNextMonth($nextMonth);
    }

    getNextMonth($_POST['start_date']);
    // simple chart display here
    $date = "";
    $upto = $time;
    $i = 0;
    $totalint = 0;
    $payment_date = date("Y m,d");
    $tp = 0;
    function getEmi($t)
    {
        global $i, $upto, $totalint, $rate, $monthly, $payment_date, $arr, $_SESSION, $tp;
        $i++;

        $principal = $_POST['principal'];
        $interest = $_POST['interest'];
        $paymonth = $_POST['months'];
        $loandate = $_POST['start_date'];
        $monthly_principal = round(($principal / $paymonth), 2);
        $monthly_interest = round((($monthly_principal * $interest) / 100), 2);
        $total_monthly_payment = round(($monthly_interest + $monthly_principal), 2);
        $r = $t * $rate;
        // $p = round($monthly - $r);
        $end_balance = (round($t - $monthly_principal, 2));
        if ($upto <= 0) {
            return 0;
        }
        if ($upto == 1) {
            $end_balance = '0.00';
        }
        $totalint = $totalint + $r;
        $tp = $tp + $monthly;
        $upto--;
?>
        <tr>
            <td>
                <?php echo $i; ?></td>
            <td>
                <?php

                $arrDate1 = explode('-', $arr[$i - 1]);
                echo date("M j, Y", mktime(0, 0, 0, floatval($arrDate1[1]), floatval($arrDate1[2]), floatval($arrDate1[0])));
                ?></td>
            <td>
                <?php echo ($monthly_interest); ?>
            </td>
            <td>
                <?php echo ($t); ?>
            </td>
            <td>
                <?php echo ($monthly_principal);  ?>
            </td>
            <td>
                <?php echo ($total_monthly_payment); ?>
            </td>
            <td>
                <?php

                echo ($end_balance);  ?>
                <?php $t = $end_balance; ?>
            </td>
        </tr>
<?php
        return getEmi($end_balance);
    }
}
function truncate_number($number, $precision = 2)
{

    // Zero causes issues, and no need to truncate
    if (0 == (int)$number) {
        return $number;
    }

    // Are we negative?
    $negative = $number / abs($number);

    // Cast the number to a positive to solve rounding
    $number = abs($number);

    // Calculate precision number for dividing / multiplying
    $precision = pow(10, $precision);

    // Run the math, re-applying the negative value to ensure
    // returns correctly negative / positive
    return floor($number * $precision) / $precision * $negative;
}
?>