<?php
// session_start();
if (!(isset($_SESSION['superadminloggedin']) && $_SESSION['superadminloggedin'] == true)) {
    header('Location: ../login.php');
}
require_once './other_controller/permission_controller.php';
include '../db/connect.php';
$per = new permission();
$userid = $_SESSION['id'];

$sql = "SELECT * FROM admins WHERE a_id='$userid'";
$abc = $pdo->prepare($sql);
$abc->execute();
$dat = $abc->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/test_icon.png" type="image/ico" />

    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/datatables.min.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/datatables.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/af-2.3.7/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/cr-1.5.4/date-1.1.0/fc-3.3.3/fh-3.1.9/kt-2.6.2/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/af-2.3.7/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/cr-1.5.4/date-1.1.0/fc-3.3.3/fh-3.1.9/kt-2.6.2/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../prompt_action/prompt-boxes.min.css">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- select2 css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Dropify css -->
    <link rel="stylesheet" href="../assets/plugins/dropify/dist/css/dropify.min.css">
    <script src="./../config.js"></script>
    <!-- Custom Theme Style 
        -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style>
        .dropify-wrapper .dropify-message p {
            margin: 11px 0 0;
            font-size: 2rem;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">


                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">

                            <a href="index"><img src="../images/logo/hitechvision.jpg" alt="..." class="img-circle profile_img"></a>
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $dat['a_fullname'];  ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="index"><i class="fa fa-home"></i> Dashboard</a>

                                </li>
                                <li><a><i class="fa fa-users" aria-hidden="true"></i> Customers <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php

                                        if ($per->permit('p_add_customer', $pdo)) {
                                            echo '<li><a href="registration">Registration</a></li>';
                                        }
                                        echo '<li><a href="viewcustomer">View Customer</a></li>
                    ';
                                        ?>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> Savings<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if ($per->permit('p_make_save', $pdo)) {
                                            echo '<li><a href="masiksavings">Saving Entry</a></li>';
                                        }
                                        if ($per->permit('p_undosave', $pdo)) {
                                            echo '<li><a href="masiksavingscheckup">Saving Roll Back</a></li>';
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <li><a><span class="iconify" data-icon="fa-solid:piggy-bank" data-inline="false" style="font-size:20px;"></span>&nbsp EMI <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if ($per->permit('p_emicalculator', $pdo)) {
                                            echo '<li><a href="emicalculator">EMI Calculator</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="loans">Loans</a></li>';
                                        }
                                        if ($per->permit('p_loanentry', $pdo)) {
                                            echo '<li><a href="emiloanentry">EMI Loan Entry</a></li>';
                                        }
                                        if ($per->permit('p_emipayment', $pdo)) {
                                            echo '<li><a href="loanpayment">EMI Payment</a></li>';
                                        }
                                        if ($per->permit('p_emisettlement', $pdo)) {
                                            echo '<li><a href="loansettlement"> EMI Settlement</a></li>';
                                        }
                                        if ($per->permit('p_undoemi', $pdo)) {
                                            echo '<li><a href="paymentrollback">Payment Roll Back</a></li>';
                                        }
                                        ?>




                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if ($per->permit('p_savingreport', $pdo)) {
                                            echo '<li><a href="paymentreport"> Saving Payment Report</a></li>';
                                        }
                                        if ($per->permit('p_emireport', $pdo)) {
                                            echo '<li><a href="loanpaymentreport"> EMI Payment Report</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="loanreports">Loans Report</a></li>';
                                        }
                                        if ($per->permit('p_emireport', $pdo)) {
                                            echo '<li><a href="loansettlementreport"> EMI Settlement Report</a></li>';
                                        }
                                        if ($per->permit('p_customerreport', $pdo)) {
                                            echo '<li><a href="customerreport">Customer Report</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="accountwisereport">Account Wise Report</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="customerwisereport">Customer Wise Report</a></li>';
                                        }
                                        ?>




                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bullhorn"></i> Notice <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="penaltynotice"> Penalty Notice</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="bulksms">Bulk SMS</a></li>';
                                        }
                                        ?>




                                    </ul>
                                </li>

                                <li><a><i class="fa fa-wrench" aria-hidden="true"></i>Setup <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if ($per->permit('p_viewadminaccount', $pdo)) {
                                            echo '<li><a href="viewadminaccount">Admin Acount</a></li>';
                                        }
                                        if ($per->permit('p_viewstaffaccount', $pdo)) {
                                            echo '<li><a href="viewstaffaccount">Staff Acount</a></li>';
                                        }
                                        if ($per->permit('p_viewnotification', $pdo)) {
                                            echo '<li><a href="notification">Notification </a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="permission">Permission Management</a></li>';
                                        }
                                        ?>



                                    </ul>
                                </li>
                                <li><a><i class="fa fa-wpexplorer" aria-hidden="true"></i>Extra <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php

                                        if ($per->permit('p_viewsalary', $pdo)) {
                                            echo '<li><a href="salarysheetentry">Salary Sheet</a></li>';
                                        }
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            echo '<li><a href="stocks">Stocks</a></li>';
                                        }

                                        ?>



                                    </ul>
                                </li>
                                        <?php
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                echo '<li><a href="accessmanagement"><i class="fa fa-bed" aria-hidden="true"></i>Bedtime Management</a>
                                </li>
                                    ';
                                        }

                                        ?>


                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings" href="profile">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" id="fbutton">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Home" href="index">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <script src="../prompt_action/prompt-boxes.min.js"></script>
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
                var npb = new PromptBoxes({
                    attrPrefix: 'pb',
                    speeds: {
                        backdrop: 250, // The enter/leaving animation speed of the backdrop
                        toasts: 250 // The enter/leaving animation speed of the toast
                    },

                    toasts: {
                        direction: 'top', // Which direction to show the toast  'top' | 'bottom'
                        max: 5, // The number of toasts that can be in the stack
                        duration: 7000, // The time the toast appears
                        showTimerBar: true, // Show timer bar countdown
                        closeWithEscape: true, // Allow closing with escaping
                        allowClose: false, // Whether to show a "x" to close the toast
                    }
                });
            </script>
            <script>
                var goFS = document.getElementById("fbutton");
                goFS.addEventListener("click", function() {
                    document.body.requestFullscreen();
                }, false);
            </script>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>


                    <nav class="nav navbar-nav">


                        <ul class=" navbar-right">
                            <span style="color:#46ae53;margin-left: -50px;font-size: 15px;">HITEC VISION PVT. LTD. | </span>
                            <span style="color:red;font-size: 15px;"><i class="fa fa-calendar"> </i> <?php
                                                                                                        date_default_timezone_set('Asia/Kathmandu');
                                                                                                        echo date("Y-m-d h:i:sa");  ?></span>

                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    if (!$dat['a_profile_image'] == '') {
                                        echo '<img src="../images/profile/' . $dat['a_profile_image'] . '" alt="">';
                                    } else {
                                        echo '<img src="../images/logo/hitechvision.jpg" alt="">';
                                    }
                                    echo $dat['a_department'];
                                    ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile"> Profile</a>
                                    <a class="dropdown-item" href="forgotpassword"> Change Password</a>
                                    <a class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                            <!-- //////////////////////////// -->
                            <li role="presentation" class="nav-item dropdown open" id="notif">

                            </li>
                            <!-- ---------------------------- -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php echo $content; ?>


            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Copyright @ 2020 - Light Web Group
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <script type="text/javascript">
        var cc = 0;
        loading_data2();
        // setInterval(loading_data, 1000);

        function loading_data() {
            $.ajax({
                url: "other_controller/notification_count.php",
                method: "POST",
                success: function(data) {
                    if (data > 0) {
                        loading_data2();
                        if (data.length > cc) {
                            npb.clear();
                            npb.success('<i class="fa fa-bell fa-lg" aria-hidden="true"></i> New Notification');
                            cc = data.length;
                        }


                    }


                }
            });
        }

        function loading_data2() {
            $.ajax({
                url: "other_controller/notification.php",
                method: "POST",
                success: function(data) {

                    $('#notif').html(data);

                }
            });
        }
    </script>
    <script src="../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script>
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        });
    </script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>

    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>

    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>

    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="../build/js/custom.min.js"></script>

    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <script type="text/javascript">
        $('.select2').select2({
            theme: 'bootstrap4',
        });
    </script>


</body>

</html>