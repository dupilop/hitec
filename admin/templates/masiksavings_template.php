<?php
require('../db/connect.php');
?>



<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">




    <div class="table-responsive display">
      <?php

      $asd = $pdo->query("SELECT * FROM customers c
                  LEFT JOIN advances ad ON c.c_id=ad.adv_c_id
                  ");

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
                  Loan amount: <br> </b>
              </div>
              <div class="col-auto">
                <?php echo $dat2['c_number']; ?><br>
                <?php echo $dat2['c_name']; ?><br>
                <?php echo $dat2['c_occupation']; ?><br>
                <?php echo $dat2['c_mobile']; ?><br>
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
    <div class="row">
      <div class="col-xl-12 col-md-2 mb-4">
        <div class="card shadow h-100 py-2" style="background:white;">
          <div class="card-body" style="color:black;">
            <div class="row no-gutters align-items-center">
              <div class="table-responsive">
                <?php
                $asd = $pdo->query("SELECT * FROM masiksavings ms
                LEFT JOIN customers c ON ms.c_id=c.c_id 
                WHERE ms.c_id='$shid'
                ");

                ?>
                <table class="table table-bordered table-striped table-hover table-sm example2" id="example2" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Previous saving</th>
                      <th>Savings</th>
                      <th>Withdrawn</th>
                      <th>New Amount</th>

                    </tr>

                  </thead>
                  <tfoot>
                    <tr style="color:white;background: red;">
                      <th colspan="2">Total</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>

                  </tfoot>

                  <tbody>

                    <?php
                    $vv = 1;
                    foreach ($asd as $a) {
                      $s = $a['ms_dateupload'];
                      $totamt = $a['ms_amount'] - $a['ms_withdraw_amount'];
                      echo '<tr>';
                      echo '<td>' . $vv . '</td>';
                      echo '<td>' . $s . '</td>';
                      echo '<td>' . $a['ms_previous_saving'] . '</td>';
                      echo '<td>' . $a['ms_amount'] . '</td>';
                      echo '<td>' . $a['ms_withdraw_amount'] . '</td>';
                      echo '<td>' . $totamt . '</td>';

                      echo '</tr>';
                      $vv++;
                    }
                    ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }
  ?>

</div>
<script type="text/javascript">
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
    responsive: true
  });
</script>
<script>
  var table2 = $("#example2").DataTable({
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"]
    ],
    orderCellsTop: true,
    fixedHeader: true,
    dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-6'i><'col-sm-6'p>>",

    buttons: [{
        extend: 'copy',
        text: '<i class="fa fa-copy"></i>',
        titleAttr: 'COPY',
        exportOptions: {
          columns: "thead th:not(.noExport)"
        }
      }, {
        extend: 'print',

        text: '<i class="fa fa-print"></i>',
        title: '<div style="text-align:center;"><img src="../../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

        titleAttr: 'Print',
        footer: true,
        autoPrint: true,
        exportOptions: {
          columns: "thead th:not(.noExport)",
        },
        customize: function(win) {
          $(win.document.body)
            .css('background', 'white')
            .css('font-size', 'inherit')

        }
      }, {
        extend: 'pdf',
        text: '<i class="fa fa-file-pdf-o"></i>',
        title: $('h1').text(),
        titleAttr: 'PDF',
        exportOptions: {
          columns: "thead th:not(.noExport)"
        },
        footer: true
      },
      {
        extend: 'csv',
        text: '<i class="fa fa-file-o"></i>',
        titleAttr: 'CSV',
        title: $('h1').text(),
        exportOptions: {
          columns: "thead th:not(.noExport)"
        }
      },
      {
        extend: 'excel',
        titleAttr: 'EXCEL',
        text: '<i class="fa fa-file-excel-o"></i>',
        title: $('h1').text(),
        exportOptions: {
          columns: "thead th:not(.noExport)"
        }
      },
      {
        extend: 'colvis',
        titleAttr: 'Column Visibility',
        text: '<i class="fa fa-bars"></i>'
      },


    ],
    responsive: true,
    "footerCallback": function(row, data, start, end, display) {
      var api = this.api(),
        data;

      var intVal = function(i) {
        return typeof i === 'string' ?
          i.replace(/[\$,]/g, '') * 1 :
          typeof i === 'number' ?
          i : 0;
      };




      total2 = api
        .column(3, {
          page: 'current'
        })
        .data()
        .reduce(function(a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      $(api.column(3).footer()).html(
        'Rs.' + total2
      );
      total3 = api
        .column(4, {
          page: 'current'
        })
        .data()
        .reduce(function(a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      $(api.column(4).footer()).html(
        'Rs.' + total3
      );

      total4 = api
        .column(5, {
          page: 'current'
        })
        .data()
        .reduce(function(a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      $(api.column(5).footer()).html(
        'Rs.' + total4
      );

      total5 = api
        .column(6, {
          page: 'current'
        })
        .data()
        .reduce(function(a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      $(api.column(6).footer()).html(
        'Rs.' + total5
      );




    }

  });
</script>
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