<?php

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






        <table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example" style="width:100%">
            <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>
            <thead class="thead-dark">
                <tr>
                    <th class="sear">Date</th>
                    <th class="sear">Customer Name</th>
                    <th class="sear">Account Number</th>
                    <th class="sear">Saving Amount</th>
                    <th class="sear">Withdraw Amount</th>
                    <th class="sear">Total Savings</th>
                    <th class="fear" style="width:1%;"></th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="sear">Date</th>
                    <th class="sear">Customer Name</th>
                    <th class="sear">Account Number</th>
                    <th class="sear">Saving Amount</th>
                    <th class="sear">Withdraw Amount</th>
                    <th class="sear">Total Savings</th>
                    <th class="fear" style="width:1%;"></th>

                </tr>
            </tfoot>
            <tbody>
                <?php

                //   foreach ($asd as $a) {
                //     $s = $a['ms_dateupload'];
                //     $dt = new DateTime($s);
                //     $year = $dt->format('Y');
                //     $month = $dt->format('m');
                //     $date = $dt->format('d');


                //     echo '<tr>';
                //     echo '<td>' . $a['c_number'] . '</td>';

                //     echo '<td>' . $a['c_name'] . '</a></td>';
                //     echo '<td>' . $a['ms_amount'] . '</td>';
                //     echo '<td>' . $a['ms_withdraw_amount'] . '</td>';
                //     echo '<td>' . $a['ms_previous_saving'] . '</td>';
                //     $totsaving = $a['ms_amount'] + $a['ms_previous_saving'] - $a['ms_withdraw_amount'];
                //     echo '<td>' . $totsaving . '</td>';

                //     $dateObj   = DateTime::createFromFormat('!m', $month);
                //     $monthName = $dateObj->format('F');
                //     echo '<td>' . $monthName . '</td>';
                //     echo '<td>' . $year . '</td>';
                //     echo '<td>' . $date . '</td>';
                //     echo '<td><a href="rollbackmasiksavings?ms_id=' . $a['ms_id'] . '" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Edit Saving"><i class="fa fa-times" aria-hidden="true"></i></td>';
                //     echo '</tr>';
                //   }
                ?>

            </tbody>
        </table>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $(".datepicker").datepicker();
            format = "yy/dd/mm"
        });

        // Bootstrap datepicker
        $('.input-daterange input').each(function() {
            $(this).datepicker('clearDates');
        });
        // Setup - add a text input to each footer cell
        var table2 = $('#example').DataTable({
            autoWidth: false,
            orderCellsTop: true,
            fixedHeader: true,
            responsive: true,
            // processing: true,
            ajax: {
                url: savingpaymentreports,
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
                    "data": "msamount"
                },
                {
                    "data": "mswithdrawamount"
                },
                {
                    "data": "totalamount"
                },
                {
                    data: "ms_id",
                    render: function(data) {
                        return "<a href='rollbackmasiksavings?ms_id=" + data + "'><button class='btn btn-md btn-outline-danger m-1 cancelbtn' id=" + data + ">Cancel</button></a>";
                    }
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            orderCellsTop: true,
            fixedHeader: true,
            dom: "<'row'<'col-sm-4'><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>"

        });

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