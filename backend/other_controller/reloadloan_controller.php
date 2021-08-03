<?php
require '../../db/connect.php';
session_start();
if ($_SESSION['access_level'] == 'superadmin') {
  $asd = $pdo->prepare("SELECT * FROM customers c
            INNER JOIN loans l ON c.c_id=l.l_c_id WHERE l.l_status='unpaid'
            ");
  $asd->execute();
} else if ($_SESSION['access_level'] == 'admin') {
  $asd = $pdo->prepare("SELECT * FROM loans l 
            INNER JOIN customers c ON c.c_id=l.l_c_id
            INNER JOIN admins a ON a.a_id=c.c_created_by 
            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE (c.c_created_by=:cby || ra.ras_parent_id=:upby) && l.l_status='unpaid'
            ");
  $asd->execute(['cby' => $_SESSION['id'], 'upby' =>  $_SESSION['id']]);
} else if ($_SESSION['access_level'] == 'staff') {
  $asd = $pdo->prepare("SELECT * FROM loans l
            INNER JOIN customers c ON c.c_id=l.l_c_id
            INNER JOIN admins a ON a.a_id=c.c_created_by 
            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby && l.l_status='unpaid'
            ");
  $asd->execute(['cby' => $_SESSION['id']]);
} else {
}

?>
<table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example" style="width:100%">

  <thead class="thead-dark">
    <tr>
      <th class="sear">Loan ID</th>
      <th class="sear">Account Number</th>
      <th class="sear">Customer Name</th>
      <th class="sear">Citizenship No.</th>
      <th class="sear">Remaining loan</th>
      <th class="fear" style="width:10%;"></th>

    </tr>
  </thead>
  <tfoot>
    <tr>
      <th class="sear">Loan ID</th>
      <th class="sear">Account Number</th>
      <th class="sear">Customer Name</th>
      <th class="sear">Citizenship No.</th>
      <th class="sear">Remaining loan</th>
      <th class="fear" style="width:10%;"></th>

    </tr>
  </tfoot>
  <tbody>
    <?php

    foreach ($asd as $a) {



      echo '<tr>';
      echo '<td><p class="text-secondary"> #' . $a['l_id'] . '</p></td>';
      echo '<td>' . $a['c_number'] . '</td>';

      echo '<td>' . $a['c_name'] . '</a></td>';
      echo '<td>' . $a['c_citizenship_number'] . '</td>';
      echo '<td>' . $a['l_remaining_loan'] . '</td>';
      $advance_amount = $a['l_remaining_loan'];
      echo '<td>
      <button id="' . $a['l_id'] . '" class="btn btn-light loanpay" data-toggle="tooltip" data-placement="top" title="Add payment"><i class="fa fa-plus"></i></button>
      <button id="' . $a['l_id'] . '" class="btn btn-inline-light showmodalemi" data-toggle="tooltip" data-placement="top" title="View EMI"><i class="fa fa-eye"></i></button>
      </td>';
      echo '</tr>';
    }
    ?>

  </tbody>
</table>
<div class="modal fade" id="modalemi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">EMI Calculator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="row">
          <div class="col">
            <h6>Name: </h6>
            <h6>Loan Amount: </h6>
            <h6>Remaining Loan: </h6>
            <h6>Down Payment: </h6>
            <h6>Loan Date: </h6>
          </div>
          <div class="col">
            <span>Abhinav</span>
            <span>Abhinav</span>
            <span>Abhinav</span>
            <span>Abhinav</span>
            <span>Abhinav</span>
          </div>
        </div> -->
        <table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example3" style="width:100%">

          <thead style="background:red;color:white;">
            <tr>
              <th class="">#</th>
              <th class="">Payment Date</th>
              <th class="">Interest</th>
              <th class="">Beginning Balance</th>
              <th class="">Principle</th>
              <th class="">Total Payment</th>
              <th class="">Ending Balance</th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="">#</th>
              <th class="">Payment Date</th>
              <th class="">Interest</th>
              <th class="">Beginning Balance</th>
              <th class="">Principle</th>
              <th class="">Total Payment</th>
              <th class="">Ending Balance</th>

            </tr>
          </tfoot>
          <tbody>

          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script>
  function getData(data) {
    $('#example3').DataTable().destroy();
    var table3 = $('#example3').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      filter: true,
      sortable: true,
      ajax: {
        url: "http://localhost/hitecnepal.com/api/emi/emicalculator.php",
        type: "POST",
        data: data,
      },
      "columns": [{
          'data': 'counter'
        },
        {
          'data': 'date'
        },
        {
          'data': 'interest'
        },
        {
          'data': 'bbalance'
        },
        {
          'data': 'principle'
        },
        {
          'data': 'tpayment'
        },
        {
          'data': 'ebalance'
        }
      ]

    });
  }
  $(document).on("click", ".showmodalemi", function(e) {
    e.preventDefault();
    $("#modalemi").modal('show');
    var l_id = $(this).attr("id");
    var data = {
      l_id: l_id
    }
    getData(data);
  })

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
    fixedHeader: true
  });
</script>