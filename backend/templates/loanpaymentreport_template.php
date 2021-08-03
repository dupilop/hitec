<?php
require '../db/connect.php';
require_once('other_controller/permission_controller.php');
require './../config.php';
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_savingreport', $pdo)) {
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
                            <input type="text" id="max-date" class="form-control date-range-filter datepicker"  placeholder="To:">
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
        <th>Total</th>

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
      
    </tr>
</tfoot>

<tbody>

  

</tbody>
</table>
<script type="text/javascript">
 $( function() {
        $( ".datepicker" ).datepicker();
        format="yy/dd/mm"
    } );

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
                total4 = api
                    .column(6, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(6).footer()).html(
                    'Rs.' + total4
                );
                total5 = api
                    .column(7, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(7).footer()).html(
                    'Rs.' + total5
                );

               
            }

        });
        // Extend dataTables search
        $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min-date').val();
            var max = $('#max-date').val();
            var createdAt = data[0] || 0  // Our date column in the table

            if (
            (min == "" || max == "" ) ||
                (
                    moment(createdAt).isSameOrAfter(min) 
                &&  moment(createdAt).isSameOrBefore(max)
                 
                )  
            ) 
            {
            return true;
            }
            return false;
        }
        );

        // Re-draw the table when the a date range filter changes
        $('.filterme').click(function() {
        table2.draw();
        });
        $(".clearfilter").click(function(){
            $("#clear")[0].reset();
            table2.draw();
        })

        $('#ex_filter').hide();
        // var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
        // $("#couu").html('Total Records: ' + table_length2);

        // table2.on('search.dt', function() {
        //     var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
        //     $("#couu").html('Total Records: ' + table_length2);

        // });
        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex) {
        //         var min = $('#month').val();
        //         var type = data[6];

        //         if (min == type || min == '') {

        //             return true;
        //         }
        //         return false;
        //     }
        // );
        // $("#monn").val(month.value);
        // $('#month').change(function() {
        //     $("#monn").val(this.value);
        //     table2.draw();

        // });
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
        // $('#year').change(function() {
        //     $("#yrs").val(this.value);
        //     table2.draw();
        // });
        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex) {
        //         var min = $('#date').val();
        //         var type = data[8];

        //         if (min == type || min == '') {
        //             return true;
        //         }

        //         return false;
        //     }
        // );
        // $('#date').change(function() {
        //     $("#dat").val(this.value);
        //     table2.draw();
        // });
        // table2.column(6).visible(false);
        // table2.column(7).visible(false);
        // table2.column(8).visible(false);


    });
</script>