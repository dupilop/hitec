<?php
// session_start();
require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_make_save', $pdo)) {
  header('Location: permissiondenied.php');
}
?>



<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">

    <script type="text/javascript">
      $(function() {
        // Setup - add a text input to each footer cell
        $('#example thead tr').clone(true).appendTo('#example thead');
        $('#example thead tr:eq(1) th.sear').each(function(i) {
          var title = $(this).text();
          $(this).html('<input type="text" class="form-control"/>');

          $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
              table
                .column(i)
                .search(this.value)
                .draw();
            }
          });

        });


        var table = $('#example').DataTable({
          orderCellsTop: true,
          fixedHeader: true,
          responsive: true,
          processing: true,
          language: {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
          }

        });

        var table2 = $('#example2').DataTable({
          orderCellsTop: true,
          fixedHeader: true,
          responsive: true
        });
      });
    </script>


    <div class="table-responsive display">
      <?php
      if ($_SESSION['access_level'] == 'superadmin') {
        $asd = $pdo->prepare("SELECT * FROM customers c
                  LEFT JOIN advances ad ON c.c_id=ad.adv_c_id
                  ");
        $asd->execute();
      } else if ($_SESSION['access_level'] == 'admin') {
        $asd = $pdo->prepare("SELECT * FROM customers c
                  LEFT JOIN advances ad ON c.c_id=ad.adv_c_id
                  INNER JOIN admins a ON a.a_id=c.c_created_by 
                  INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby || ra.ras_parent_id=:upby
                  ");
        $asd->execute(['cby' => $_SESSION['id'], 'upby' =>  $_SESSION['id']]);
      } else if ($_SESSION['access_level'] == 'staff') {
        $asd = $pdo->prepare("SELECT * FROM customers c
                  LEFT JOIN advances ad ON c.c_id=ad.adv_c_id
                  INNER JOIN admins a ON a.a_id=c.c_created_by 
                  INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby");
        $asd->execute(['cby' => $_SESSION['id']]);
      } else {
        header('Location: permissiondenied.php');
      }
      ?>
      <table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example" style="width:100%">

        <thead class="thead-dark">
          <tr>
            <th class="sear">Account Number</th>
            <th class="sear">Customer Name</th>
            <th class="sear">Customer Occupation</th>
            <th class="sear">Total Savings</th>
            <th class="fear" style="width:1%;"></th>

          </tr>
        </thead>
        <tfoot>
          <tr>
            <th class="sear">Account Number</th>
            <th class="sear">Customer Name</th>
            <th class="sear">Customer Address</th>
            <th class="sear">Total Savings</th>
            <th class="fear" style="width:1%;"></th>

          </tr>
        </tfoot>
        <tbody>
          <?php

          foreach ($asd as $a) {



            echo '<tr>';
            echo '<td>' . $a['c_number'] . '</td>';

            echo '<td>' . $a['c_name'] . '</a></td>';
            echo '<td>' . $a['c_occupation'] . '</td>';
            echo '<td>' . $a['c_total_saving_amount'] . '</td>';
            echo '<td><a href="masiksavings?c_id=' . $a['c_id'] . '" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Add Saving"><i class="fa fa-plus"></i></td>';
            echo '</tr>';
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="container-fluid">

  <?php

  if (isset($_GET['c_id'])) {
    $shid = $_GET['c_id'];
    $dat2 = $pdo->query("SELECT * FROM customers c 
              WHERE c.c_id ='$shid'")->fetch();
    $lonn = $pdo->prepare("SELECT * FROM customers c 
              INNER JOIN loans l on c.c_id = l.l_c_id
              WHERE c.c_id ='$shid' && l_status='unpaid'");
    $lonn->execute();
    $lon = $lonn->fetch();
    $rcount = $lonn->rowCount();
  ?>

    <div class="row">
      <div class="col-xl-4 col-md-2 mb-4">
        <div class="card shadow h-30 py-2" style="background:#2a3f54;color:white;">
          <div class="card-body" style="color:white;">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <b>Account No:<br>
                  Name:<br>
                  Occupation: <br>
                  Contact No: <br>
                  Address: <br>
                  Loan amount: <br> </b>
              </div>
              <div class="col-auto">
                <?php echo $dat2['c_number']; ?><br>
                <?php echo $dat2['c_name']; ?><br>
                <?php echo $dat2['c_occupation']; ?><br>
                <?php echo $dat2['c_mobile']; ?><br>
                <?php echo $dat2['c_current_address']; ?><br>
                <?php
                if ($rcount > 0) {
                  echo $lon['l_amount'] . '<br>';
                } else {
                  echo 'No current Loan applied <br>';
                }
                ?>
              </div>
            </div>
          </div>

        </div>
      </div>



      <div class="col-xl-8 col-md-2 mb-4">
        <div class="card shadow h-100 py-2" style="background:white;">
          <div class="card-body" style="color:black;">
            <div class="row no-gutters align-items-center">
              <form action="masiksavings" method="POST">
                <div class="col mr-2 form-group row">
                  <label for="total_amount" class="col-lg-7 col-form-label"><b>Saving Amount:</b></label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="saving_amount" name="ms_amount" value="" style="width: 100%;">
                  </div>
                </div>
                <div class="col mr-2 form-group row">
                  <label for="total_amount" class="col-lg-7 col-form-label"><b>Withdraw Amount:</b></label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="withdraw_amount" name="ms_withdraw_amount" value="" style="width: 100%;">
                  </div>
                </div>


                <div class="col mr-2 form-group row">
                  <label for="advance_amount" class="col-lg-7 col-form-label"><b>Total Saving Amount:</b></label>
                  <div class="col-sm-5">


                    <input type="text" readonly class="form-control-plaintext" id="total_savingamount" name="ms_previous_saving" value="<?php echo $dat2['c_total_saving_amount']; ?>" style="width: 100%;">

                  </div>
                </div>


                <div class="col mr-2 form-group row">
                  <label for="totamt" class="col-lg-7 col-form-label"><b>New Total Savings: </b></label>
                  <div class="col-sm-5">
                    <input type="text" readonly class="form-control-plaintext" id="new_total_saving_amount" name="c_total_saving_amount" style="width: 100%;">
                  </div>
                </div>

                <div class="row no-gutters align-items-center" style="margin-left: 300px;">
                  <input type="hidden" name="c_id" value="<?php echo $dat2['c_id']; ?>" class="form-control">
                  <input type="submit" value="Save" id="pay" name="pay" class="form-control btn-success">

                </div>

              </form>
            </div>



          </div>
        </div>
      </div>
    </div>


  <?php }
  ?>

</div>
<script type="text/javascript">
  var saving_amount = $("#saving_amount").val();
  var saving_amount_uptodate = $("#total_savingamount").val();
  var new_total_saving_amount = $("#new_total_saving_amount").val();
  var withdraw_amount = $("#withdraw_amount").val();
  var new_saving = Number(saving_amount) + Number(saving_amount_uptodate) - Number(withdraw_amount);
  $("#new_total_saving_amount").val(new_saving);

  $("#saving_amount").on("change keyup", function() {
    var saving_amount = $(this).val();
    var saving_amount_uptodate = $("#total_savingamount").val();
    var withdraw_amount = $("#withdraw_amount").val();
    var new_saving = Number(saving_amount) + Number(saving_amount_uptodate) - Number(withdraw_amount);
    $("#new_total_saving_amount").val(new_saving);
  });

  $("#withdraw_amount").on("change keyup", function() {
    var saving_amount = $("#saving_amount").val();
    var saving_amount_uptodate = $("#total_savingamount").val();
    var withdraw_amount = $(this).val();
    var new_saving = Number(saving_amount) + Number(saving_amount_uptodate) - Number(withdraw_amount);
    $("#new_total_saving_amount").val(new_saving);
  });
</script>