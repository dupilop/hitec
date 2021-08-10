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
                        <th class="sear">Citizenship Number</th>
                        <th class="sear">Mobile Number</th>
                        <th class="fear" style="width:1%;"></th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="sear">Account Number</th>
                        <th class="sear">Customer Name</th>
                        <th class="sear">Citizenship Number</th>
                        <th class="sear">Mobile Number</th>
                        <th class="fear" style="width:1%;"></th>

                    </tr>
                </tfoot>
                <tbody>
                    <?php

                    foreach ($asd as $a) {



                        echo '<tr>';
                        echo '<td>' . $a['c_number'] . '</td>';

                        echo '<td>' . $a['c_name'] . '</a></td>';
                        echo '<td>' . $a['c_citizenship_number'] . '</td>';
                        echo '<td>' . $a['c_mobile'] . '</td>';
                        echo '<td><a href="#" id="' . $a['c_id'] . '" class="btn btn-light showmodal" data-toggle="tooltip" data-placement="top" title="Add Saving"><i class="fa fa-plus"></i></td>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Scrollable modal -->
<div class="modal fade" id="modal1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Make a Save</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                    <div class="col-auto customerdata">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-xl-8 col-md-2 mb-4">
                        <div class="card shadow h-100 py-2" style="background:white;">
                            <div class="card-body" style="color:black;">
                                <div class="row no-gutters align-items-center">
                                    <form action="" method="POST" id="savingform1">
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


                                                <input type="text" readonly class="form-control-plaintext" id="total_savingamount" name="ms_previous_saving" style="width: 100%;">

                                            </div>
                                        </div>


                                        <div class="col mr-2 form-group row">
                                            <label for="totamt" class="col-lg-7 col-form-label"><b>New Total Savings: </b></label>
                                            <div class="col-sm-5">
                                                <input type="text" readonly class="form-control-plaintext" id="new_total_saving_amount" name="c_total_saving_amount" style="width: 100%;">
                                            </div>
                                        </div>

                                        <div class="row no-gutters align-items-center" style="margin-left: 300px;">
                                            <input type="button" value="Save" name="pay" class="form-control btn-success paysaving">

                                        </div>

                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("click", ".paysaving", function(e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var data = new FormData(document.getElementById("savingform1"));
        data.append("c_id", id);
        $.ajax({
            url: makeasave,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            headers: {
                token: localStorage.getItem('token')
            },
            success: function(data) {
                if (data.status == true) {
                    alert(data.message);
                    $("#savingform1")[0].reset();
                    $("#modal1").modal("hide");
                } else {
                    alert(data.message);
                }
            }
        })

    })
    $(document).on("click", ".showmodal", function(e) {
        e.preventDefault();
        $("#modal1").modal("show");
        var id = $(this).attr("id");
        $.ajax({
            url: customerdetails + '?c_id=' + id,
            method: "GET",
            data: {
                c_id: id
            },
            contentType: false,
            processData: false,
            headers: {
                token: localStorage.getItem('token')
            },
            success: function(data) {
                $(".customerdata").html(data.data.c_number + '<br>' + data.data.c_name + '<br>' + data.data.c_occupation + '<br>' + data.data.c_mobile + '<br>' + data.data.c_current_address + '<br>' + ((data.data.l_amount) ? data.data.l_amount + '<br>' : 'No current Loan applied <br>'));
                $("#total_savingamount").val(data.data.c_total_saving_amount);
                var saving_amount = $("#saving_amount").val();
                var saving_amount_uptodate = $("#total_savingamount").val();
                var new_total_saving_amount = $("#new_total_saving_amount").val();
                var withdraw_amount = $("#withdraw_amount").val();
                var new_saving = Number(saving_amount) + Number(saving_amount_uptodate) - Number(withdraw_amount);
                $("#new_total_saving_amount").val(new_saving);
                $(".paysaving").attr("id", data.data.c_id);
            }


        });
    })
</script>
<script type="text/javascript">
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