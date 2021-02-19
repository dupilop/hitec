<?php
require '../../db/connect.php';
$asd = $pdo->query("SELECT * FROM customers c
            INNER JOIN loans l ON c.c_id=l.l_c_id
            ");

?>
<table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example" style="width:100%">

  <thead class="thead-dark">
    <tr>
      <th class="sear">Loan ID</th>
      <th class="sear">Account Number</th>
      <th class="sear">Customer Name</th>
      <th class="sear">Citizenship No.</th>
      <th class="sear">Remaining loan</th>
      <th class="fear" style="width:1%;"></th>

    </tr>
  </thead>
  <tfoot>
    <tr>
      <th class="sear">Loan ID</th>
      <th class="sear">Account Number</th>
      <th class="sear">Customer Name</th>
      <th class="sear">Citizenship No.</th>
      <th class="sear">Remaining loan</th>
      <th class="fear" style="width:1%;"></th>

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
      echo '<td><button id="' . $a['l_id'] . '" class="btn btn-light loanpay" data-toggle="tooltip" data-placement="top" title="Add payment"><i class="fa fa-plus"></i></button></td>';
      echo '</tr>';
    }
    ?>

  </tbody>
</table>
<script>
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