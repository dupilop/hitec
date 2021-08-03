<?php
require './../db/connect.php';
require './other_controller/penaltycalculator.php';

if ($_SESSION['access_level'] == 'superadmin' || $_SESSION['access_level'] == 'admin') {
?>
    <div class="col-md-12 col-sm-4">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Deadline Notice</h2>
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
            <div class="card">
                <div class="card-body">
                    <form id="clear">
                        <div class="row">

                            <!-- <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input type="text" id="anumber" name="accountnumber" class="form-control" placeholder="Account Number">
                                </div>
                            </div> -->
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
                            <div class="col-md-4 pl-2 mt-4 text-center">
                                <div class="form-group">
                                    <a class="btn btn-success btn-sm filterme" href="#"><i class="fa fa-filter"></i> Filter</a>
                                    <a class="btn btn-secondary btn-sm clearfilter" href="#"><i class="fa fa-eraser"></i> Clear Filter</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <hr>
            <div class="x_content">
                <div class="dashboard-widget-content">
                    <?php
                    $d1 = $pdo->prepare("SELECT * FROM loans l
        INNER JOIN customers c ON l.l_c_id=c.c_id");
                    $d1->execute();
                    ?>
                    <table class="table table-sm table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Penalty Amount</th>
                                <th>Nearby Deadline</th>
                                <th class="noExport">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($d1 as $d2) {
                                $pdamt = $d2['l_amount'] - $d2['l_remaining_loan'] - $d2['l_down_payment'];
                                $penalty = pencalc($d2['l_amount'], date_create(date('Y-m-d', strtotime($d2['l_upload_date_time']))), $d2['l_down_payment'], $pdamt, date_create(date('Y-m-d')), 0.16);
                                $dat1 = date("Y-m-d", strtotime($d2['l_upload_date_time']));
                                $deadline = deadline($dat1);
                                echo '<tr>
                <td># ' . $d2['l_id'] . '</td>
                <td>' . $d2['c_name'] . '</td>
                <td>' . round($penalty, 2) . '</td>
                <td>' . $deadline . '<small>(' . $dat1 . ')</small></td>

                <td><button class="btn btn-sm btn-outline-success sendnotice" id="' . $d2['c_id'] . '"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Notice</button></td>
              </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for messaging -->
    <div class="modal fade" id="messagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" action="" autocomplete="off" id="form2" method="post" novalidate>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control-plaintext" readonly id="c_name" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Mobile<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control-plaintext" name="c_mobile" id="c_mobile" />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Message<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea class="form-control" name="message" id="message">Please clear your due</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary sendmessage">Send</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $(function() {
            $(".datepicker").datepicker();
            format = "yy/dd/mm"
        });

        // Bootstrap datepicker
        $('.input-daterange input').each(function() {
            $(this).datepicker('clearDates');
        });
        var table2 = $('#example').DataTable({
            "order": [
                [3, "desc"]
            ],
            // "ordering": false,
            // pageLength: 5,
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
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: $('h1').text(),
                    titleAttr: 'Print',
                    exportOptions: {
                        columns: ':not(.no-print)'
                    },
                    footer: true,
                    autoPrint: false,
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('background', 'white')
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

            ]
        });
        // Extend dataTables search
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[3] || 0 // Our date column in the table

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

    });
    $(document).on("click", ".sendmessage", function(e) {
        e.preventDefault();
        var num = $("#c_mobile").val();
        var message = $("#message").val();
        $.ajax({
            url: "other_controller/sendmessagenotice.php",
            method: "POST",
            data: {
                num: num,
                message: message,
                action: "sendmessage"
            },
            context: this,
            success: function(data) {
                var a = JSON.parse(data);
                if (a.success == true) {
                    alert(a.message);
                } else {
                    alert("Error while sending");
                }
            }
        });
    })
    $(document).on("click", ".sendnotice", function() {
        var id = $(this).attr("id");
        $("#messagemodal").modal("show");
        $.ajax({
            url: "other_controller/getcustomerdetails.php",
            method: "POST",
            data: {
                id: id,
                action: "getcustomer"
            },
            context: this,
            success: function(data) {
                var a = JSON.parse(data);
                var d = a[0];
                $("#c_name").val(d.c_name);
                $("#c_mobile").val(d.c_mobile);
            }
        });
    });
</script>