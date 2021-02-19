<?php
require('../db/connect.php');
require 'other_controller/penaltycalculator.php';
?>



<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">




    <div class="table-responsive display" id="reloadloan">

    </div>
  </div>
</div>


<div class="container-fluid" id="relpay">



</div>
<script type="text/javascript">
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
        title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

        titleAttr: 'Print',
        footer: true,
        autoPrint: true,
        exportOptions: {
          columns: "thead th:not(.noExport)",
        },
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
  relloan();

  function relloan() {
    $("#reloadloan").html('<i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
      url: "other_controller/reloadloan_controller.php",
      method: "POST",
      success: function(data) {
        $('#reloadloan').html(data);
      }
    });

  }

  function relloan2(id) {
    $("#relpay").html('<i class="fa fa-spinner fa-spin fa-2x">');
    $.ajax({
      url: "other_controller/reloadloanpayment_controller.php",
      method: "POST",
      data: {
        id: id
      },
      success: function(data) {
        // alert(data);
        $('#relpay').html(data);
      }
    });
  }
  $(document).on("click", ".loanpay", function() {
    var id = $(this).attr("id");
    relloan2(id);
  });
  $(document).on("click", ".pay", function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById("payform"));
    // var data = new FormData(document.getElementById("relloan"));
    console.log(data);
    $(".relbtn").html('<i class="fa fa-spinner fa-spin fa-2x">');
    $.ajax({
      url: "other_controller/payloan_controller.php",
      method: "POST",
      data: data,
      contentType: false,
      processData: false,
      success: function(data) {

        // alert(data);
        $('#payform')[0].reset();
        $('.relbtn').html('<button id="pay" name="pay" class="form-control btn-outline-success pay">Pay</button>');
        relloan();
        relloan2(data);
        pb.clear();
        pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Loan Paid Successfully');
      }
    });

  });
</script>