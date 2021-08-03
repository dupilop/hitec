<?php
require './config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EMI- Login</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="prompt_action/prompt-boxes.min.css">
    <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <img src="images/logo/hitechvision.jpg" width="100px" height="100px">
                    <form action="" method="POST" id="form1">
                        <h1>Hitech Vision Pvt Ltd</h1>
                        <div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" name="email" id="email" class='email' required="required" type="email" />

                                </div>
                                <div class="emailerror"></div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" type="password" id="password" name="password" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
                                </div>
                                <div class="passerror"></div>
                            </div>
                            <div class="field item form-group">
                                <div class="col-md-11 col-sm-8 relbtn">
                                    <button type="button" name="login" id="login" style="float: right;" class="btn btn-outline-primary">Login</button><br>
                                </div>
                            </div>
                        </div>

                        <div>

                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">


                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <p>©2020 All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</body>

</html>
<script src="prompt_action/prompt-boxes.min.js"></script>
<script>
    var pb = new PromptBoxes({
        attrPrefix: 'pb',
        speeds: {
            backdrop: 250, // The enter/leaving animation speed of the backdrop
            toasts: 250 // The enter/leaving animation speed of the toast
        },
        prompt: {
            inputType: 'text', // The type of input 'text' | 'password' etc.
            submitText: 'Submit', // The text for the submit button
            submitClass: '', // A class for the submit button
            cancelText: 'Cancel', // The text for the cancel button
            cancelClass: '', // A class for the cancel button
            closeWithEscape: true, // Allow closing with escaping
            absolute: false // Show prompt popup as absolute
        },
        confirm: {
            confirmText: 'Confirm', // The text for the confirm button
            confirmClass: '', // A class for the confirm button
            cancelText: 'Cancel', // The text for the cancel button
            cancelClass: '', // A class for the cancel button
            closeWithEscape: true, // Allow closing with escaping
            absolute: false // Show prompt popup as absolute
        },
        toasts: {
            direction: 'top', // Which direction to show the toast  'top' | 'bottom'
            max: 5, // The number of toasts that can be in the stack
            duration: 3000, // The time the toast appears
            showTimerBar: false, // Show timer bar countdown
            closeWithEscape: true, // Allow closing with escaping
            allowClose: false, // Whether to show a "x" to close the toast
        }
    });
</script>
<script type="text/javascript">
    $("#login").on("click", function(e) {
        e.preventDefault();
        $(".relbtn").html('<button type="button" name="login" id="login" style="float: right;" class="btn btn-outline-primary" disabled>Processing</button>');
        var email = $("#email").val();
        var password = $("#password").val();
        var evalidation = false;
        var pvalidation = false;
        if (!validateEmail(email)) {

            $(".emailerror").html("<p class='text text-danger'>Email is invalid</p>");
        } else {
            if ($.trim(email) == '') {
                $(".emailerror").html("<p class='text text-danger'>Email is invalid</p>");
            } else {
                $(".emailerror").html("<p class='text text-success'>Looks Good!</p>");
                evalidation = true;
            }
        }
        if ($.trim(password) == '') {
            $(".passerror").html("<p class='text text-danger'>Password is empty</p>");
        } else {
            $(".passerror").html("<p class='text text-success'></p>");
            pvalidation = true;
        }
        if (evalidation == true && pvalidation == true) {
            var data = {
                email: email,
                password: password
            };
            // var data = JSON.stringify(data);
            $.ajax({
                type: "POST",
                url: adminlogin,
                data: data,
                success: function(data) {
                    $(".relbtn").html('<button type="button" name="login" id="login" style="float: right;" class="btn btn-outline-primary" disabled><i class="fa fa-spinner fa-spin"></i> Logging in</button>');
                    if (data.status === true) {

                        pb.clear();
                        pb.success('<i class="fa fa-sign-in" aria-hidden="true"></i> ' + data.message);
                        localStorage.setItem('token', data.data.a_token);
                        setTimeout(function() {
                            window.location.href = 'backend/';
                        }, 2000);
                    } else {
                        $("#form1")[0].reset();
                        $(".relbtn").html('<button name="login" id="login" style="float: right;" class="btn btn-outline-primary">Login</button>');
                        pb.clear();
                        pb.error('<i class="fa fa-sign-in" aria-hidden="true"></i>' + data.message);
                    }

                },
                error: function(data) {

                    $("#form1")[0].reset();
                    $(".relbtn").html('<button name="login" id="login" style="float: right;" class="btn btn-outline-primary">Login</button>');
                    pb.clear();
                    pb.error('<i class="fa fa-sign-in" aria-hidden="true"></i> Cannot establish a secure connection');
                }
            });
        } else {
            // alert('asd');
            // $("#form1")[0].reset();
            $(".relbtn").html('<button name="login" id="login" style="float: right;" class="btn btn-outline-primary">Login</button>');
            pb.clear();
            pb.error('<i class="fa fa-sign-in" aria-hidden="true"></i> Cannot establish a secure connection');
        }

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    });
</script>