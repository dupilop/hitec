<?php
require '../db/connect.php';
$abc = new DatabaseTable('superadmins');
$abc = $pdo->query("SELECT * FROM superadmins WHERE sa_id=" . $_SESSION['id'])->fetch();
?>
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Profile </h2>
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
                    <form class="" id="form1" action="" method="post" enctype="multipart/form-data" novalidate>


                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">New Password<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" id="password1" name="password" required />
                                <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                    <i id="slash" class="fa fa-eye-slash"></i>
                                    <i id="eye" class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm Password<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="password" id="cpassword1" />
                                <span style="position: absolute;right:15px;top:7px;" onclick="hideshow2()">
                                    <i id="slash2" class="fa fa-eye-slash"></i>
                                    <i id="eye2" class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>




                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <input type="hidden" name="sa_id" value="<?php echo $abc['sa_id']; ?>">
                                    <button type='button' name="update" class="btn btn-primary chpass">Update</button>
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

<script type="text/javascript">
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

    function hideshow2() {
        var cpassword = document.getElementById("cpassword1");
        var slash2 = document.getElementById("slash2");
        var eye2 = document.getElementById("eye2");

        if (cpassword.type === 'password') {
            cpassword.type = "text";
            slash2.style.display = "block";
            eye2.style.display = "none";
        } else {
            cpassword.type = "password";
            slash2.style.display = "none";
            eye2.style.display = "block";
        }

    }

    $(document).on("click", ".chpass", function(e) {
        e.preventDefault();
        var p1 = $("#password1").val();
        var p2 = $("#cpassword1").val();
        if (p1 == p2 && $.trim(p1) != '') {
            var ab = pb.prompt(

                function callback(value) {
                    var data = {
                        password: value
                    };
                    $.ajax({
                        type: "POST",
                        url: "./other_controller/passwordcheck_controller.php",
                        data: data,

                        success: function(data) {
                            if ($.trim(data) == 'true') {
                                var formdata = new FormData(document.getElementById("form1"));
                                formdata.append('action', 'changepassword');
                                $.ajax({
                                    type: "POST",
                                    url: "./other_controller/profile_controller.php",
                                    data: formdata,
                                    contentType: false,
                                    context: this,
                                    processData: false,
                                    success: function(data) {
                                        $("#form1")[0].reset();
                                        pb.clear();
                                        pb.success('<span class="fe fe-16 fe-check-circle"></span>Password Successfully Updated');
                                    }
                                });
                            } else {
                                alert('Invalid password');
                            }


                        }
                    });
                },
                '<p class="text text-primary">Enter your password to confirm</p>',
                'password',
                '',
                'Submit',
                'Cancel'
            );
        } else {
            pb.clear();
            pb.error('Password is not same');
        }
    });
</script>