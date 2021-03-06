<?php
require '../db/connect.php';
$userid = $_SESSION['id'];
//total customers
$cusers = $pdo->prepare("SELECT * FROM customers");
$cusers->execute();
$result = $cusers->fetchAll();
$total_row = $cusers->rowCount();

//total male customers
$cusers2 = $pdo->prepare("SELECT * FROM customers WHERE c_gender='Male'");
$cusers2->execute();
$result2 = $cusers2->fetchAll();
$total_row2 = $cusers2->rowCount();

//total female customers
$cusers3 = $pdo->prepare("SELECT * FROM customers WHERE c_gender='Female'");
$cusers3->execute();
$result3 = $cusers3->fetchAll();
$total_row3 = $cusers3->rowCount();

//total others customers
$cusers33 = $pdo->prepare("SELECT * FROM customers WHERE c_gender='Others'");
$cusers33->execute();
$result33 = $cusers33->fetchAll();
$total_row33 = $cusers33->rowCount();

//total collection
$cusers4 = $pdo->prepare("SELECT * FROM masiksavings");
$cusers4->execute();
$result4 = $cusers4->fetchAll();
$tot = 0;
$total_row4 = $cusers4->rowCount();
if ($total_row > 0) {
  foreach ($result4 as $con) {
    $tot = $tot + $con['ms_amount'];
  }
}

$cusers44 = $pdo->prepare("SELECT * FROM loan_transactions");
$cusers44->execute();
$result44 = $cusers44->fetchAll();
$tot44 = 0;
$total_row44 = $cusers44->rowCount();
if ($total_row44 > 0) {
  foreach ($result44 as $con44) {
    $tot44 = $tot44 + $con44['lt_grand_total'];
  }
}
echo $tot;
//total collections including loans and savings
$totcollections = $tot + $tot44;



//today savings collection 
date_default_timezone_set('Asia/Kathmandu');
$today = date("Y-m-d");
$cusers5 = $pdo->prepare("SELECT * FROM masiksavings WHERE ms_dateupload LIKE '%$today%'");
$cusers5->execute();
$result5 = $cusers5->fetchAll();
$tot5 = 0;
$total_row5 = $cusers5->rowCount();
if ($total_row5 > 0) {
  foreach ($result5 as $con5) {
    $tot5 = $tot5 + $con5['ms_amount'];
  }
}

//today loans collections
$cusers55 = $pdo->prepare("SELECT * FROM loan_transactions WHERE lt_uploaddate LIKE '%$today%'");
$cusers55->execute();
$result55 = $cusers55->fetchAll();
$tot55 = 0;
$total_row55 = $cusers55->rowCount();
if ($total_row55 > 0) {
  foreach ($result55 as $con55) {
    $tot55 = $tot55 + $con55['lt_grand_total'];
  }
}

//today total collection
$totall5 = $tot5 + $tot55;

//yesterday 

$d = strtotime("-1 Days");
$yesterday =  date("Y-m-d", $d);
$ycusers5 = $pdo->prepare("SELECT * FROM masiksavings WHERE ms_dateupload LIKE '%$yesterday%'");
$ycusers5->execute();
$yresult5 = $ycusers5->fetchAll();
$ytot5 = 0;
$ytotal_row5 = $ycusers5->rowCount();
if ($ytotal_row5 > 0) {
  foreach ($yresult5 as $ycon5) {
    $ytot5 = $ytot5 + $ycon5['ms_amount'];
  }
}

//yesterday loans collections
$ycusers55 = $pdo->prepare("SELECT * FROM loan_transactions WHERE lt_uploaddate LIKE '%$yesterday%'");
$ycusers55->execute();
$yresult55 = $ycusers55->fetchAll();
$ytot55 = 0;
$ytotal_row55 = $ycusers55->rowCount();
if ($ytotal_row55 > 0) {
  foreach ($yresult55 as $ycon55) {
    $ytot55 = $ytot55 + $ycon55['lt_grand_total'];
  }
}

//yesterday total collection
$ytotall5 = $ytot5 + $ytot55;


//collection two days before
$d2 = strtotime("-2 Days");
$twodayago =  date("Y-m-d", $d2);
$ycusers6 = $pdo->prepare("SELECT * FROM masiksavings WHERE ms_dateupload LIKE '%$twodayago%'");
$ycusers6->execute();
$yresult6 = $ycusers6->fetchAll();
$ytot6 = 0;
$ytotal_row6 = $ycusers6->rowCount();
if ($ytotal_row6 > 0) {
  foreach ($yresult6 as $ycon6) {
    $ytot6 = $ytot6 + $ycon6['ms_amount'];
  }
}
//2 day ago loans collections
$ycusers66 = $pdo->prepare("SELECT * FROM loan_transactions WHERE lt_uploaddate LIKE '%$twodayago%'");
$ycusers66->execute();
$yresult66 = $ycusers66->fetchAll();
$ytot66 = 0;
$ytotal_row66 = $ycusers66->rowCount();
if ($ytotal_row66 > 0) {
  foreach ($yresult66 as $ycon66) {
    $ytot66 = $ytot66 + $ycon66['lt_grand_total'];
  }
}

//2 day ago total collection
$ytotall6 = $ytot6 + $ytot66;

//staff count
$susers = $pdo->prepare("SELECT * FROM admins a 
INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:rname");
$susers->execute(['rname' => 'staff']);
$result6 = $susers->fetchAll();
$total_row6 = $susers->rowCount();

//admin count
$ausers = $pdo->prepare("SELECT * FROM admins a 
INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:rname");
$ausers->execute(['rname' => 'admin']);
$result7 = $ausers->fetchAll();
$total_row7 = $ausers->rowCount();

//stock count
$stusers = $pdo->prepare("SELECT * FROM stocks");
$stusers->execute();
$result8 = $stusers->fetchAll();
$total_row8 = $stusers->rowCount();
?>
<div class="row" style="display: inline-block;width: 100%;">
  <div class="tile_count">
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
      <div class="count"><?php echo $total_row;  ?></div>
    </div>


    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Admins</span>
      <div class="count"><?php echo $total_row7;  ?></div>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Staffs</span>
      <div class="count"><?php echo $total_row6;  ?></div>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Today Collections</span>
      <div class="count"><?php echo $totall5;  ?></div>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
      <div class="count"><?php echo $totcollections;  ?></div>
    </div>

    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Stocks</span>
      <div class="count green"><?php echo $total_row8;  ?></div>
    </div>
  </div>
</div>
<!-- /top tiles -->

<br />

<div class="row">


  <div class="col-md-4 col-sm-4 ">
    <div class="x_panel tile fixed_height_320">
      <div class="x_title">
        <h2>Quick Collection Report</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Settings 1</a>
              <a class="dropdown-item" href="#">Settings 2</a>
            </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <h4>Recent 3 Days</h4>
        <h6>Target Amount: 1 Lakh</h6>
        <div class="widget_summary">
          <div class="w_left w_25">
            <span>Today</span>
          </div>
          <div class="w_center w_55">
            <?php

            $target = 100000;
            $tcollection = (($target - $totall5) / $target) * 100;
            $tcollectionn = 100 - $tcollection;
            $variable = $tcollectionn . '%';
            $inktoday = ($totall5 / 1000) . ' K';
            echo "<div class='progress' data-toggle='tooltip' data-placement='top' title='" . $variable . "'>";
            echo   "<div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: " . $variable . "'>";
            ?>
            <span class="sr-only">60% Complete</span>
          </div>
        </div>
      </div>
      <div class="w_right w_20">
        <span><?php echo '<p style="font-size:14px;">' . $inktoday . '</p>'; ?></span>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="widget_summary">
      <div class="w_left w_25">
        <span>Yesterday</span>
      </div>
      <div class="w_center w_55">
        <?php
        $ytarget = 100000;

        $ytcollection = (($ytarget - $ytotall5) / $ytarget) * 100;
        $ytcollectionn = 100 - $ytcollection;

        $yvariable = $ytcollectionn . '%';
        $inkyest = ($ytotall5 / 1000) . ' K';
        echo "<div class='progress' data-toggle='tooltip' data-placement='top' title='" . $yvariable . "'>";

        echo   "<div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='" . $yvariable . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $yvariable . "'>";
        ?>

        <span class="sr-only"><?php echo $yvariable; ?> Complete</span>
      </div>
    </div>
  </div>
  <div class="w_right w_20">
    <span><?php echo '<p style="font-size:14px;">' . $inkyest . '</p>'; ?></span>
  </div>
  <div class="clearfix"></div>
</div>

<div class="widget_summary">
  <div class="w_left w_25">
    <span>2 Days ago</span>
  </div>
  <div class="w_center w_55">
    <?php
    $ytarget2 = 100000;

    $ytcollection2 = (($ytarget2 - $ytotall6) / $ytarget2) * 100;
    $ytcollectionn2 = 100 - $ytcollection2;

    $yvariable2 = $ytcollectionn2 . '%';
    $inkyest2 = ($ytotall6 / 1000) . ' K';
    echo "<div class='progress' data-toggle='tooltip' data-placement='top' title='" . $yvariable2 . "'>";
    echo   "<div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='" . $yvariable2 . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $yvariable2 . "'>";
    echo $yvariable2;
    ?>

    <span class="sr-only"><?php echo $yvariable2; ?> Complete</span>
  </div>
</div>
</div>
<div class="w_right w_20">
  <span><?php echo '<p style="font-size:14px;">' . $inkyest2 . '</p>'; ?></span>
</div>
<div class="clearfix"></div>
</div>


</div>
</div>
</div>
<?php

$total_row2;
$total_row;
$permale = (($total_row - $total_row2) / $total_row) * 100;
$permalee = number_format(100 - $permale, 2);
$perfemale = (($total_row - $total_row3) / $total_row) * 100;
$perfemalee = number_format(100 - $perfemale, 2);
$perother = (($total_row - $total_row33) / $total_row) * 100;
$perotherr = number_format(100 - $perother, 2);

$c_array = array($permalee, $perfemalee, $perotherr);
echo '<script type="text/javascript">
                  
                  var dat = ' . json_encode($c_array) . ';
                </script>';
?>
<div class="col-md-4 col-sm-4 ">
  <div class="x_panel tile fixed_height_320 overflow_hidden">
    <div class="x_title">
      <h2>Customers Overview</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Settings 1</a>
            <a class="dropdown-item" href="#">Settings 2</a>
          </div>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table class="" style="width:100%">
        <tr>
          <th style="width:37%;">
            <p>Customers Pie chart</p>
          </th>
          <th>
            <div class="col-lg-7 col-md-7 col-sm-7 ">
              <p class="">Types</p>
            </div>

          </th>
        </tr>
        <tr>
          <td>
            <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
          </td>
          <td>
            <table class="tile_info">
              <tr>
                <td>
                  <p><i class="fa fa-square red"></i>Males </p>
                </td>
                <td><?php echo $permalee; ?>%</td>
              </tr>
              <tr>
                <td>
                  <p><i class="fa fa-square purple"></i>Females</p>
                </td>
                <td><?php echo $perfemalee; ?>%</td>
              </tr>
              <tr>
                <td>
                  <p><i class="fa fa-square green"></i>Others</p>
                </td>
                <td><?php echo $perotherr; ?>%</td>
              </tr>

            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>


<div class="col-md-4 col-sm-4 ">
  <div class="x_panel tile fixed_height_320">
    <div class="x_title">
      <h2>Quick Settings</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Settings 1</a>
          </div>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="dashboard-widget-content">
        <ul class="quick-list">
          <li><i class="fa fa-calendar-o"></i><a href="profile">Profile</a>
          </li>
          <li><i class="fa fa-bars"></i><a href="notification">Notification</a>
          </li>
          <li><i class="fa fa-bar-chart"></i><a href="viewcustomer">Customers</a> </li>
          <li><i class="fa fa-line-chart"></i><a href="stocks">Stocks</a>
          </li>
          <li><i class="fa fa-bar-chart"></i><a href="viewstaffaccount">Staffs</a> </li>

          <li><i class="fa fa-area-chart"></i><a href="../logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- </div> -->