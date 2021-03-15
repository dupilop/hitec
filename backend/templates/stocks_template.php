<?php

require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if ($per->permit('p_add_stock', $pdo)) {
?>

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Stock Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="" method="post" id="form1" novalidate>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="desc" name="st_desc" />
                                </div>
                                <div class="descerror"></div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Model No<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="modelno" name="st_model_no" />
                                </div>
                                <div class="modelnoerror"></div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Price<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="price" name="st_price" type="text" />
                                </div>
                                <div class="priceerror"></div>
                            </div>


                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Purchase Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="pdate" type="date" name="st_date">
                                </div>
                                <div class="pdateerror"></div>
                            </div>





                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <input type="hidden" readonly name="st_created_by" value="<?php echo $userid;  ?>">
                                        <button type='submit' id="add" name="add" class="btn btn-primary add">Add</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>
<script>
    function hideshow() {
        var password = document.getElementById("password1");
        var slash = document.getElementById("slash");
        var eye = document.getElementById("eye");

        if (password.type === 'password') {
            password.type = "text";
            slash.style.display = "block";
            eye.style.display = "none";
        } else {
            password.type = "password";
            slash.style.display = "none";
            eye.style.display = "block";
        }

    }
</script>


<div id="user_data">

</div>
<script type="text/javascript">
    load_data();

    function load_data() {
        $.ajax({
            url: "other_controller/viewstock.php",
            method: "POST",
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }
    $(document).on('submit', '#form1', function(e) {
        e.preventDefault();
        var desc = $("#desc").val();
        var modelno = $("#modelno").val();
        var price = $("#price").val();
        var pdate = $("#pdate").val();
        dvalidation = false;
        mvalidation = false;
        prvalidation = false;
        pdvalidation = false;
        if ($.trim(desc) == '') {
            $(".descerror").html("<p class='text text-danger'>Description is empty</p>");
        } else {
            $(".descerror").html("<p class='text text-success'></p>");
            dvalidation = true;
        }
        if ($.trim(modelno) == '') {
            $(".modelnoerror").html("<p class='text text-danger'>Model number is empty</p>");
        } else {
            $(".modelnoerror").html("<p class='text text-success'></p>");
            mvalidation = true;
        }
        if ($.trim(price) == '') {
            $(".priceerror").html("<p class='text text-danger'>Price is empty</p>");
        } else {
            $(".priceerror").html("<p class='text text-success'></p>");
            prvalidation = true;
        }
        if ($.trim(pdate) == '') {
            $(".pdateerror").html("<p class='text text-danger'>Date is empty</p>");
        } else {
            $(".pdateerror").html("<p class='text text-success'></p>");
            pdvalidation = true;
        }
        if (dvalidation == true && mvalidation == true && prvalidation == true && pdvalidation == true) {
            $.ajax({
                type: "POST",
                url: "other_controller/addstock.php",
                data: new FormData(document.getElementById("form1")),
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#form1")[0].reset();
                    load_data();
                    pb.clear();
                    pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Stock Added Successfully');
                }
            });
        } else {
            pb.clear();
            pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Please fill all the forms correctly');
        }
    });
    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $("#myModal" + id).modal('show');
    });
    $(document).on('click', '.delete', function(e) {
        var id = $(this).attr('id');
        var data = 'id=' + id;
        e.preventDefault();
        pb.confirm(
            function(outcome) {
                if (outcome) {
                    $.ajax({
                        type: "GET",
                        url: "other_controller/deletestock.php?did=" + id,
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            load_data();
                            pb.clear();
                            pb.error('<i class="fa fa-trash fa-lg" aria-hidden="true"></i>   Deleted Successfully');

                        }
                    });
                }
            },
            '<h4 class="text text-danger">Are you sure you want to delete?</h4>',
            'Yes',
            'No'

        );

    });
</script>