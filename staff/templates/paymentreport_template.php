<?php

require('../db/connect.php');

?>
<script type="text/javascript">
  var total = 0;
</script>

<style type="text/css">
  .center {
    position: absolute;
    left: 70%;
    width: 100px;



  }
</style>

<script type="text/javascript">
  $(document).ready(function() {

    var table2 = $('#example').DataTable({

      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
      ],
      orderCellsTop: true,
      fixedHeader: true,
      responsive: true,
      dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'i><'col-sm-6'p>>",
      buttons: [{
          extend: 'copy',
          text: '<i class="fa fa-copy"></i>',
          titleAttr: 'COPY'
        }, {
          extend: 'print',

          text: '<i class="fa fa-print"></i>',
          title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

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

            var mon = $("#monn").val();
            var yrs = $("#yrs").val();
            var date = $("#dat").val();
            var comdate = '';
            if (mon == '' && yrs == '' && date == '') {
              comdate = ' All time';
            }
            if (yrs != '') {

              yrs = '-' + yrs;
            }
            if (date != '') {

              date = '-' + date;
            }
            if (mon == '') {
              yrs = $("#yrs").val();
            }
            if (mon == '' && yrs == '') {
              date = $("#dat").val();
            }
            $(win.document.body).find('#pdate').prepend('<div style="text-align:center;font-size:15px;color:black;"><b>SAVINGS MADE ON : ' + mon + yrs + date + comdate + '</b></div>');

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
      "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
          data;

        var intVal = function(i) {
          return typeof i === 'string' ?
            i.replace(/[\$,]/g, '') * 1 :
            typeof i === 'number' ?
            i : 0;
        };

        total = api
          .column(6)
          .data()
          .reduce(function(a, b) {
            return intVal(Number(a)) + intVal(Number(b));
          }, 0);

        total1 = api
          .column(2, {
            page: 'current'
          })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        $(api.column(2).footer()).html(
          'Rs.' + total1
        );
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
      }

    });
    var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
    $("#couu").html('Total Records: ' + table_length2);

    table2.on('search.dt', function() {
      var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
      $("#couu").html('Total Records: ' + table_length2);

    });
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var min = $('#month').val();
        var type = data[6];

        if (min == type || min == '') {

          return true;
        }
        return false;
      }
    );
    $("#monn").val(month.value);
    $('#month').change(function() {
      $("#monn").val(this.value);
      table2.draw();

    });
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var min = $('#year').val();
        var type = data[7];

        if (min == type || min == '') {
          return true;
        }

        return false;
      }
    );
    $('#year').change(function() {
      $("#yrs").val(this.value);
      table2.draw();
    });
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var min = $('#date').val();
        var type = data[8];

        if (min == type || min == '') {
          return true;
        }

        return false;
      }
    );
    $('#date').change(function() {
      $("#dat").val(this.value);
      table2.draw();
    });
    table2.column(6).visible(false);
    table2.column(7).visible(false);
    table2.column(8).visible(false);


  });
</script>
<table>
  <tr>
    <th style="padding: 20px;">Month</th>
    <td>
      <select class="form-control" id="month" style="padding: 10px;">
        <option value="">Select Month</option>
        <option>January</option>
        <option>February</option>
        <option>March</option>
        <option>April</option>
        <option>May</option>
        <option>June</option>
        <option>July</option>
        <option>August</option>
        <option>September</option>
        <option>October</option>
        <option>November</option>
        <option>December</option>
      </select>
    </td>

    <th style="padding: 20px;">Year</th>
    <td>
      <?php
      date_default_timezone_set('Asia/Kathmandu');
      ?>
      <?php $years = range(2000, strftime("%Y", time())); ?>
      <select class="form-control" id="year" style="padding: 10px;">
        <option value="">Select Year</option>
        <?php foreach ($years as $year) : ?>
          <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
        <?php endforeach; ?>
      </select>
    </td>
    <th style="padding: 20px;">Date</th>
    <td>
      <select class="form-control" id="date" style="padding: 8px;">
        <option value="">Select Date</option>
        <?php

        for ($i = 1; $i < 33; $i++) {
          if (strlen($i) == 1) {
            $i = '0' . $i;
          }
          echo '<option>' . $i . '</option>';
        }

        ?>

      </select>
    </td>
  </tr>
</table>
<input type="hidden" id="monn" value="">
<input type="hidden" id="yrs" value="">
<input type="hidden" id="dat" value="">
<?php
$asd = $pdo->query("SELECT * FROM masiksavings ms
                    INNER JOIN customers c ON ms.c_id=c.c_id 
                    ");
echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">';
echo '<p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>';

?>
<thead class="thead-dark">
  <tr>
    <th>Customer Name</th>
    <th>Account Number</th>
    <th>Saving Amount</th>
    <th>Withdraw Amount</th>
    <th>Old Savings</th>
    <th>New Savings</th>

    <th>Month</th>
    <th>Year</th>
    <th>Date</th>
  </tr>
</thead>
<tfoot>
  <tr style="color:white;background: red;">
    <th>Total</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
</tfoot>

<tbody>

  <?php
  foreach ($asd as $a) {
    $s = $a['ms_dateupload'];
    $dt = new DateTime($s);

    $date = $dt->format('d');
    echo '<tr>';
    echo '<td>' . $a['c_name'] . '</td>';
    echo '<td>' . $a['c_number'] . '</td>';
    echo '<td>' . $a['ms_amount'] . '</td>';
    echo '<td>' . $a['ms_withdraw_amount'] . '</td>';
    echo '<td>' . $a['ms_previous_saving'] . '</td>';
    $totsaving = $a['ms_amount'] + $a['ms_previous_saving'] - $a['ms_withdraw_amount'];
    echo '<td>' . $totsaving . '</td>';

    $dateObj   = DateTime::createFromFormat('!m', $a['ms_month']);
    $monthName = $dateObj->format('F');
    echo '<td>' . $monthName . '</td>';
    echo '<td>' . $a['ms_year'] . '</td>';
    echo '<td>' . $date . '</td>';

    echo '</tr>';
  }
  ?>

</tbody>
</table>