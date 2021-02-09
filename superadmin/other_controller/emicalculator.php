<?php 
session_start();
error_reporting(0); 
$rate = $_POST['interest']/100/12;
$principle = $_POST['principal'];
$time = $_POST['years']*12;// in month
$x= pow(1+$rate,$time);
//echo $x;
$monthly = ($principle*$x*$rate)/($x-1);
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
        $<?php echo number_format(round($r)); ?>.00
    </td>
    <td>
        $<?php  echo number_format($t); ?>.00
    </td>
    <td>
        $<?php echo number_format($p);  ?>.00
    </td>
    <td>       
        $<?php echo number_format($monthly); ?>.00
    </td>
    <td>        
        $<?php echo number_format(round($e));  ?>.00
    </td>
</tr>
<?php
    return getEmi($e);
}
?>
<style type="text/css">
    table#emi{
        border:1px solid #d4d4d4;
        margin:0 auto;
        font-family:'Cantora One', sans-serif;
        font-size:14px;
    }
    table#emi td{
        padding:5px;
    }
    table#emi tr:nth-child(even){
        background:#E4E4E4;
        border:1px solid #D4D4D4;
        border-left:0;
        border-right:0;
    }
    table#emi tr td:nth-last-child(1){
        background:#D7E4FF;
    }
    table#emi input{
        margin-bottom:5px !important;
        margin-top:5px;
    }
    #result td{
        padding:5px;
    }
    table#result{
        width:477px;
        border:1px solid #d4d4d4;
        margin:0 auto;
        margin-top:10px;
        display:none;
        font-family:'Cantora One', sans-serif;
        font-size:14px;
    }
    table#result tr:nth-child(even){
        background:#E4E4E4;
        border:1px solid #D4D4D4;
    }
    table#result tr td:nth-last-child(1){
        width:213px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/test_icon.png" type="image/ico" />

    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index" class="site_title"><i class="fa fa-user" aria-hidden="true"></i>
              <span>EMI SOFTWARE</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../images/test_icon.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Username</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
               
                  </li>
                  <li><a><i class="fa fa-users" aria-hidden="true"></i> Customers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="registration">Registration</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Invoice<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>
                
                  <li><a><i class="fa fa-bar-chart-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs2.html">Payment Report</a></li>
                      <li><a href="chartjs2.html">Customer Report</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-wrench" aria-hidden="true"></i>Setup <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Admin Account</a></li>
                      <li><a href="fixed_footer.html">Staff Acount</a></li>
                      <li><a href="fixed_footer.html">EMI </a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="../../images/test_icon.png" alt="">Admin
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="../../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="../../mages/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="../../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="../../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
<form name="loandata" method="post" action="">
    <table id="emi" width="100%">
        <tr>
            <td colspan="3">
                <b>
                    Enter Loan Information:
                </b>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td width="48%">
                Amount of the loan (any currency):
                <span class="err">*</span>
            </td>
            <td>
                <input type="text" name="principal" size="12" >
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                Annual percentage rate of interest: 
                <span class="err">*</span>
            </td>
            <td>
                <input type="text" name="interest" size="12">
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                Repayment period in years: 
                <span class="err">*</span>
            </td>
            <td>
                <input type="text" name="years" size="12">
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                Start Date of Loan:
            </td>
            <td>
                <input type="text" name="start_date" size="12" id="start_date">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Compute"  name="EMI_submit" class="btn btn-primary">
            </td>
        </tr>
    </table>
</form>
<style type="text/css">
    .eni_list{
        border:1px solid #D4D4D4;
    }
    .eni_list tr:nth-child(2){
        font-family:'Cantora One', sans-serif;
        font-size:14px;
    }
    .eni_list td{
        padding:5px;
        border:1px solid #D5D5D5;
        text-align:center;
    }
    .eni_list tr:nth-child(even){
        background:#E4E4E4;
    }
    span.err{
        color:#F00;
        font-weight:bold;
    }
</style>
<table cellpadding="0" cellspacing="0" width="100%" class="eni_list">
    <?php 
if(!empty($_POST['principal']) || !empty($_POST['interest']) || !empty($_POST['years'])){
    if(empty($_POST['principal'])){
        $error = "Amount of the loan Cant't Be Empty.<br />";
    }
    else if(empty($_POST['interest'])){
        $error= "Annual percentage rate of interest Cant't Be Empty. <br />";
    }
    else if(empty($_POST['years'])){
        $error= "Repayment period in years Cant't Be Empty. <br />";
    }
    else {
        //simple chart dispaly here 
    ?>
    <tr>
        <td colspan="7">
            <table id="result" width="100%">
                <tr>
                    <td colspan="3">
                        <b>
                            Payment Information:
                        </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Your monthly payment will be:
                    </td>
                    <td>
                        <span id="monthly">$<?php echo round($monthly); ?>.00</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Your total payment will be:
                    </td>
                    <td>
                        <span id="total"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        Your total interest payments will be:
                    </td>
                    <td>
                        <span id="interest"></span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            S.N
        </td>
        <td>
            Payment Date
        </td>
        <td>
            Interest
        </td>
        <td>
            Beginning Balance
        </td>
        <td>
            Principle
        </td>
        <td>
            Total Payment
        </td>
        <td>
            Ending Balance
        </td>
    </tr>
    <?php
        getEmi($_POST['principal']); 
    ?>
    <script type="text/ecmascript">
        document.getElementById("interest").innerHTML="$"+<?php echo round($totalint); ?>+".00";
        document.getElementById("total").innerHTML="$"+<?php echo round($tp); ?>+".00";
    </script>
    <?php
    }}
else {
    $error= "Plese Fill Up All Required Fields.";	
}
    ?>
    <?php if(!empty($error)) : ?>
    <tr>
        <td colspan="6" style="color:#F00; font-size:18px;">
            <?php echo $error; ?></td>
    </tr>
    <?php endif; ?>
</table>
</div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright @ 2020 - Abhinav Kaphle
            <!-- Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="../build/js/custom.min.js"></script>
    
  </body>
</html>

<?php if(isset($_POST['EMI_submit'])){ ?>
<script language="JavaScript">
    document.getElementById('result').style.display='block';
</script>
<?php } ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    var j =  jQuery.noConflict();
    j(function(){
        // Datepicker
        j('#start_date').datepicker({
            inline: true,
            minDate: "today"
        })
        });
</script>
