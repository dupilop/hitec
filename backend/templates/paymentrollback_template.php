<?php

require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_undoemi', $pdo)) {
    header('Location: permissiondenied.php');
}
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

<div class="card">
    <div class="card-body">
        <form id="clear">
            <div class="row">

                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" id="anumber" name="accountnumber" class="form-control" placeholder="Account Number">
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label>From</label>
                        <input type="text" id="min-date" class="form-control date-range-filter datepicker" placeholder="From:">
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label>To</label>
                        <input type="text" id="max-date" class="form-control date-range-filter datepicker" placeholder="To:">
                    </div>
                </div>
            </div>
        </form>
        <div class="text-center">
            <a class="btn btn-success btn-sm filterme" href="#"><i class="fa fa-filter"></i> Filter</a>
            <a class="btn btn-secondary btn-sm clearfilter" href="#"><i class="fa fa-eraser"></i> Clear Filter</a>
        </div>
    </div>
</div>
<hr>

<?php

echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">';
echo '<p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>';
?>
<thead class="thead-dark">
    <tr>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Account Number</th>
        <th>Principal</th>
        <th>Discount</th>
        <th>Interest</th>
        <th>Penalty</th>
        <th>Grand Total</th>
        <th class="noExport">Action</th>


    </tr>
</thead>


<tbody>

    <?php
    // foreach ($asd as $a) {
    //     $s = $a['lt_uploaddate'];
    //     $dt = new DateTime($s);
    //     $year = $dt->format('Y');
    //     $month = $dt->format('m');
    //     $date = $dt->format('d');
    //     echo '<tr>';
    //     echo '<td>' . $a['c_name'] . '</td>';
    //     echo '<td>' . $a['c_number'] . '</td>';
    //     echo '<td>' . $a['lt_principal'] . '</td>';
    //     echo '<td>' . $a['lt_discount'] . '</td>';
    //     echo '<td>' . $a['lt_interest'] . '</td>';
    //     echo '<td>' . $a['lt_penalty'] . '</td>';
    //     echo '<td>' . $a['lt_grand_total'] . '</td>';


    //     echo '<td><a href="cancelemibill?cbid=' . $a['lt_id'] . '" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a></td>';
    //     echo '</tr>';
    // }
    ?>

</tbody>
</table>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker();
        format = "yy/dd/mm"
    });

    // Bootstrap datepicker
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
    var token = localStorage.getItem('token');
    // alert(token);
    $(document).ready(function() {

        var table2 = $('#example').DataTable({

            orderCellsTop: true,
            fixedHeader: true,
            responsive: true,
            // lengthChange: false,
            autoWidth: false,

            // processing: true,
            ajax: {
                url: loanpaymentreports,
                type: "GET",
                headers: {
                    "token": localStorage.getItem('token')
                }
            },
            "columns": [{
                    "data": "date"
                },
                {
                    "data": "cname",
                    "searchable": false
                }, {
                    "data": "cnumber"
                },
                {
                    "data": "principal"
                },
                {
                    "data": "discount"
                },
                {
                    "data": "interest"
                },
                {
                    "data": "penalty"
                },
                {
                    "data": "totalamount"
                },
                {
                    "data": "id",
                    render: function(data) {
                        return '<a href="cancelemibill?cbid=' + data + '" class="btn btn-sm btn-danger"><i class="fas fa-trash-restore"></i></a>';
                    }
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
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


                    // customize: function(win) {
                    //     $(win.document.body)
                    //         .css('background', 'white')
                    //         .css('font-size', 'inherit')

                    //     var mon = $("#monn").val();
                    //     var yrs = $("#yrs").val();
                    //     var date = $("#dat").val();
                    //     var comdate = '';
                    //     if (mon == '' && yrs == '' && date == '') {
                    //         comdate = ' All time';
                    //     }
                    //     if (yrs != '') {

                    //         yrs = '-' + yrs;
                    //     }
                    //     if (date != '') {

                    //         date = '-' + date;
                    //     }
                    //     if (mon == '') {
                    //         yrs = $("#yrs").val();
                    //     }
                    //     if (mon == '' && yrs == '') {
                    //         date = $("#dat").val();
                    //     }
                    //     $(win.document.body).find('#pdate').prepend('<div style="text-align:center;font-size:15px;color:black;"><b>SAVINGS MADE ON : ' + mon + yrs + date + comdate + '</b></div>');

                    // }
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



                total1 = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(3).footer()).html(
                    'Rs.' + total1
                );
                total2 = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(4).footer()).html(
                    'Rs.' + total2
                );
                total3 = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    'Rs.' + total3
                );


            }

        });
        // Extend dataTables search
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[0] || 0 // Our date column in the table

                if (
                    (min == "" || max == "") ||
                    (
                        moment(createdAt).isSameOrAfter(min) &&
                        moment(createdAt).isSameOrBefore(max)

                    )
                ) {
                    return true;
                }
                return false;
            }
        );

        // Re-draw the table when the a date range filter changes
        $('.filterme').click(function() {
            table2.draw();
        });
        $(".clearfilter").click(function() {
            $("#clear")[0].reset();
            table2.draw();
        })

        $('#ex_filter').hide();

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#anumber').val();
                var type = data[2];

                if (min == type || min == '') {

                    return true;
                }

                return false;
            }
        );



    });
</script>