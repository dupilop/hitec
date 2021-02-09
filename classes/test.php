<?php 
error_reporting(0); 
$_POST['years'] = $_POST['months']/12;
$rate = $_POST['interest']/100/12;
$principle = $_POST['principal'];
$time = $_POST['years']*12;// in month
$x= pow(1+$rate,$time);
if(!$_POST['interest'] == ''){
$monthly = ($principle*$rate*$x)/($x-1);
}
else{
    $monthly = ($principle / $time);
}
$monthly = round($monthly);
$k= $time;
$arr= array();
function getNextMonth($date){
    global $arr;
    global $k;
    if($k==0){
        return 0;   
    }
    $date = new DateTime($date);
    $interval = new DateInterval('P1M');
    $date->add($interval);
    $nextMonth= $date->format('Y-m-d') . "\n";  
    $arr[]= $nextMonth;
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
$tp =0;
function getEmi($t){
    global $i,$upto, $totalint, $rate,$monthly,$payment_date, $arr,$_SESSION,$tp;
    $i++;
    if($upto<=0){
        return 0;
    }
    $r = $t*$rate;
    $p = round($monthly-$r);
    $e= round($t-$p);
    if($upto==2){
        $_SESSION['tl']= $e;
    }
    if($upto==1){
        $p= $_SESSION['tl'];    
        $e= round($t-$p);
        $monthly= round($p+$r);
    }
    $totalint = $totalint + $r;
    $tp = $tp+$monthly;
    $upto--;
?>
<tr>
    <td>
        <?php echo $i; ?></td>
    <td>
        <?php
    $arrDate1 = explode('-',$arr[$i-1]);
    echo date("M j, Y",mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]));
        ?></td>
    <td>       
        <?php echo number_format(round($r)); ?>.00
    </td>
    <td>
        <?php  echo number_format($t); ?>.00
    </td>
    <td>
        <?php echo number_format($p);  ?>.00
    </td>
    <td>       
        <?php echo number_format($monthly); ?>.00
    </td>
    <td>        
        <?php echo number_format(round($e));  ?>.00
    </td>
</tr>
<?php
    return getEmi($e);
}

?>
