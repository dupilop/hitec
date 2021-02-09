<?php

require('../db/connect.php');

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
                                <input class="form-control" id="s_fullname" name="s_fullname" required="required" placeholder="Enter full name" />
                            </div>
                            <div class="s_fullname"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date of Birth<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="s_dob" class='date' type="date" name="s_dob" required='required'>
                            </div>
                            <div class="s_dob"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="s_position" class='optional' name="s_position" type="text" />
                            </div>
                            <div class="s_position"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align"> Mobile Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="s_mobile" type="number" class='number' name="s_mobile" required='required'>
                            </div>
                            <div class="s_mobile"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="s_phone" type="number" class='number' name="s_phone" required='required'>
                            </div>
                            <div class="s_phone"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Gender <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="s_gender" type="text" class='number' name="s_gender">
                            </div>
                            <div class="s_gender"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea required="required" id="s_address" name='s_address'></textarea>
                            </div>
                            <div class="s_address"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Assigned To<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" name="s_a_id">
                                    <?php
                                    $rr = $pdo->query("SELECT * FROM admins");
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
                                <input class="form-control" id="s_email" name="s_email" class='email' required="required" type="email" />
                            </div>
                            <div class="s_email"></div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" id="password1" name="s_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />

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
                                    <button type='submit' name="add" class="btn btn-primary add">Add</button>
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
<script src="../vendors/validator/multifield.js"></script>
<script src="../vendors/validator/validator.js"></script>
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
            url: "other_controller/viewstaffaccount.php",
            method: "POST",
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }
    $(document).on('submit', '#form1', function(e) {
        e.preventDefault();
        var s_fullname = $("#s_fullname").val();
        var s_dob = $("#s_dob").val();
        var s_position = $("#s_position").val();
        var s_mobile = $("#s_mobile").val();
        var s_phone = $("#s_phone").val();
        var s_gender = $("#s_gender").val();
        var s_address = $("#s_address").val();
        var s_email = $("#s_email").val();
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

        if ($.trim(s_fullname) == '') {
            $(".s_fullname").html("<p class='text text-danger'>Fullname is empty</p>");
        } else {
            $(".s_fullname").html("<p class='text text-success'></p>");
            fvalidation = true;
        }
        if ($.trim(s_dob) == '') {
            $(".s_dob").html("<p class='text text-danger'>DOB is empty</p>");
        } else {
            $(".s_dob").html("<p class='text text-success'></p>");
            dvalidation = true;
        }
        if ($.trim(s_position) == '') {
            $(".s_position").html("<p class='text text-danger'>Position is empty</p>");
        } else {
            $(".s_position").html("<p class='text text-success'></p>");
            povalidation = true;
        }
        if ($.trim(s_mobile) == '') {
            $(".s_mobile").html("<p class='text text-danger'>Mobile no is empty</p>");
        } else {
            $(".s_mobile").html("<p class='text text-success'></p>");
            mvalidation = true;
        }
        if ($.trim(s_phone) == '') {
            $(".s_phone").html("<p class='text text-danger'>Phone is empty</p>");
        } else {
            $(".s_phone").html("<p class='text text-success'></p>");
            phvalidation = true;
        }
        if ($.trim(s_gender) == '') {
            $(".s_gender").html("<p class='text text-danger'>Gender is empty</p>");
        } else {
            $(".s_gender").html("<p class='text text-success'></p>");
            gvalidation = true;
        }
        if ($.trim(s_address) == '') {
            $(".s_address").html("<p class='text text-danger'>Address is empty</p>");
        } else {
            $(".s_address").html("<p class='text text-success'></p>");
            advalidation = true;
        }

        if (!validateEmail(s_email)) {

            $(".s_email").html("<p class='text text-danger'>Email is invalid</p>");
        } else {
            if ($.trim(s_email) == '') {
                $(".s_email").html("<p class='text text-danger'>Email is invalid</p>");
            } else {
                $(".s_email").html("<p class='text text-success'>Looks Good!</p>");
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
    //  $(document).on('click', '.update', function(){

    //   var id = $(this).attr('id');
    //  var data = 'id=' + id;
    //   $.ajax({
    //                   type: "POST",
    //                   url: "other_controller/updateadmin.php?s_id="+id,
    //                   data: new FormData(document.getElementById("form2")),
    //                   contentType: false, 
    //                   processData: false,
    //                   success: function(data) {
    //                       alert(data);
    //                       load_data();
    //                        $("#myModal"+id).modal("toggle");

    //                      new PNotify({
    //                                 title: 'Updating Successful',
    //                                 type: 'success',
    //                                 styling: 'bootstrap3'
    //                             });
    //                   }
    //               });

    // });
</script>