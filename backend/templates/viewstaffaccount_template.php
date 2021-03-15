<?php

require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_viewstaffaccount', $pdo)) {
    header('Location: permissiondenied.php');
}

?>

<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Staff Controls</h2>
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
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_fullname" name="a_fullname" required="required" placeholder="Enter full name" />
                            </div>
                            <div class="a_fullname"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date of Birth<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_dob" class='date' type="date" name="a_dob" required='required'>
                            </div>
                            <div class="a_dob"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_position" class='optional' name="a_position" type="text" />
                            </div>
                            <div class="a_position"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align"> Mobile Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_mobile" type="number" class='number' name="a_mobile" required='required'>
                            </div>
                            <div class="a_mobile"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_phone" type="number" class='number' name="a_phone" required='required'>
                            </div>
                            <div class="a_phone"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Gender <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_gender" type="text" class='number' name="a_gender">
                            </div>
                            <div class="a_gender"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea required="required" id="a_address" name='a_address'></textarea>
                            </div>
                            <div class="a_address"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Assigned To<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control select2" name="ras_a_id">
                                    <?php
                                    $rr = $pdo->prepare("SELECT * FROM admins a
                                    INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                                    INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:r_name");
                                    $rr->execute(['r_name' => 'admin']);
                                    foreach ($rr as $vv) {
                                        echo '<option value="' . $vv['a_id'] . '">' . $vv['a_fullname'] . '</option>';
                                    }

                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="a_email" name="a_email" class='email' required="required" type="email" />
                            </div>
                            <div class="a_email"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" id="password1" name="a_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />

                                <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                    <i id="slash" class="fa fa-eye-slash"></i>
                                    <i id="eye" class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="password1"></div>
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm password<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="cpassword" type="password" data-validate-linked='password' required='required' />
                            </div>
                            <div class="cpassword"></div>
                        </div>

                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type='submit' name="add" class="btn btn-outline-primary add">Add</button>
                                    <button type='reset' class="btn btn-outline-success">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
        $("#user_data").html('<i class="fa fa-spinner fa-spin fa-2x">');
        $.ajax({
            url: "other_controller/viewstaffaccount.php",
            method: "POST",
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }
    $(document).on('submit', '#form1', function(e) {
        e.preventDefault();
        var a_fullname = $("#a_fullname").val();
        var a_dob = $("#a_dob").val();
        var a_position = $("#a_position").val();
        var a_mobile = $("#a_mobile").val();
        var a_phone = $("#a_phone").val();
        var a_gender = $("#a_gender").val();
        var a_address = $("#a_address").val();
        var a_email = $("#a_email").val();
        var password1 = $("#password1").val();
        var cpassword = $("#cpassword").val();
        var fvalidation = false;
        var dvalidation = false;
        var povalidation = false;
        var mvalidation = false;
        var phvalidation = false;
        var gvalidation = false;
        var advalidation = false;
        var evalidation = false;
        var p1validation = false;
        var cpvalidation = false;

        if ($.trim(a_fullname) == '') {
            $(".a_fullname").html("<p class='text text-danger'>Fullname is empty</p>");
        } else {
            $(".a_fullname").html("<p class='text text-success'></p>");
            fvalidation = true;
        }
        if ($.trim(a_dob) == '') {
            $(".a_dob").html("<p class='text text-danger'>DOB is empty</p>");
        } else {
            $(".a_dob").html("<p class='text text-success'></p>");
            dvalidation = true;
        }
        if ($.trim(a_position) == '') {
            $(".a_position").html("<p class='text text-danger'>Position is empty</p>");
        } else {
            $(".a_position").html("<p class='text text-success'></p>");
            povalidation = true;
        }
        if ($.trim(a_mobile) == '') {
            $(".a_mobile").html("<p class='text text-danger'>Mobile no is empty</p>");
        } else {
            $(".a_mobile").html("<p class='text text-success'></p>");
            mvalidation = true;
        }
        if ($.trim(a_phone) == '') {
            $(".a_phone").html("<p class='text text-danger'>Phone is empty</p>");
        } else {
            $(".a_phone").html("<p class='text text-success'></p>");
            phvalidation = true;
        }
        if ($.trim(a_gender) == '') {
            $(".a_gender").html("<p class='text text-danger'>Gender is empty</p>");
        } else {
            $(".a_gender").html("<p class='text text-success'></p>");
            gvalidation = true;
        }
        if ($.trim(a_address) == '') {
            $(".a_address").html("<p class='text text-danger'>Address is empty</p>");
        } else {
            $(".a_address").html("<p class='text text-success'></p>");
            advalidation = true;
        }

        if (!validateEmail(a_email)) {

            $(".a_email").html("<p class='text text-danger'>Email is invalid</p>");
        } else {
            if ($.trim(a_email) == '') {
                $(".a_email").html("<p class='text text-danger'>Email is invalid</p>");
            } else {
                $(".a_email").html("<p class='text text-success'>Looks Good!</p>");
                evalidation = true;
            }
        }
        if ($.trim(password1) == '') {
            $(".password1").html("<p class='text text-danger'>Password cannot be empty</p>");
        } else {
            $(".password1").html("<p class='text text-success'></p>");
            p1validation = true;
        }
        if ($.trim(cpassword) == $.trim(password1)) {
            $(".cpassword").html("<p class='text text-success'></p>");
            cpvalidation = true;
        } else {
            $(".cpassword").html("<p class='text text-danger'>Password not matched</p>");

        }
        if (fvalidation == true && dvalidation == true && povalidation == true && mvalidation == true && phvalidation == true && gvalidation == true &&
            advalidation == true && evalidation == true && p1validation == true && cpvalidation == true) {
            $.ajax({
                type: "POST",
                url: "other_controller/addstaff.php",
                data: new FormData(document.getElementById("form1")),
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#form1")[0].reset();
                    load_data();
                    pb.clear();
                    pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Admin Added Successfully');
                }
            });
        } else {
            pb.clear();
            pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Please fill all the forms correctly');
        }

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
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
                        url: "other_controller/deletestaff.php?did=" + id,
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