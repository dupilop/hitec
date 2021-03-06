<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../db/connect.php');
$userid = $_SESSION['id'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $abc = $pdo->prepare("SELECT * FROM customers WHERE c_id=:id");
    $abc->execute(['id' => $id]);
    $abc2 = $abc->fetch();
}
?>

<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Customer</h2>
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
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Account Number<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_number" name="c_number" class="form-control" value="<?php echo $abc2['c_number'] ?>">
                                </div>
                                <div class="c_number_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Citizenship Number<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_citizenship_number" onkeypress="return onlyNumberKey(event)" value="<?php echo $abc2['c_citizenship_number'] ?>" name="c_citizenship_number" class="form-control" placeholder="Enter unique number">
                                </div>
                                <div class="c_citizen_error" id="c_citizen_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_name" name="c_name" class="form-control" value="<?php echo $abc2['c_name'] ?>">
                                </div>
                                <div class="c_name_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_dob" name="c_dob" class="date-picker form-control" type="date" value="<?php echo $abc2['c_dob'] ?>">
                                </div>
                                <div class="c_dob_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Occupation <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_occupation" name="c_occupation" class="form-control" value="<?php echo $abc2['c_occupation'] ?>">
                                </div>
                                <div class="c_occupation_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Mobile Number<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_mobile" class="form-control col" type="text" name="c_mobile" value="<?php echo $abc2['c_mobile'] ?>">
                                </div>
                                <div class="c_mobile_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Phone Number</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_phone" class="form-control col" type="text" name="c_phone" value="<?php echo $abc2['c_phone'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Gender</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="c_gender" id="gender">
                                        <?php
                                        if ($abc2['c_gender'] == 'Male') {
                                            echo '<option value="Male" selected>Male</option>';
                                            echo '<option value="Female">Female</option>';
                                            echo '<option value="Other">Others</option>';
                                        } else if ($abc2['c_gender'] == 'Female') {
                                            echo '<option value="Male">Male</option>';
                                            echo '<option value="Female" selected>Female</option>';
                                            echo '<option value="Other">Others</option>';
                                        } else if ($abc2['c_gender'] == 'Other') {
                                            echo '<option value="Male">Male</option>';
                                            echo '<option value="Female">Female</option>';
                                            echo '<option value="Other" selected>Others</option>';
                                        } else {
                                            echo '<option value="Male">Male</option>';
                                            echo '<option value="Female">Female</option>';
                                            echo '<option value="Other">Others</option>';
                                        }
                                        ?>



                                    </select>

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Permanent Address <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_permanent_address" name="c_permanent_address" class="form-control" value="<?php echo $abc2['c_permanent_address'] ?>">
                                </div>
                                <div class="c_permanent_address_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Current Address<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_current_address" name="c_current_address" class="form-control" type="text" value="<?php echo $abc2['c_current_address'] ?>">
                                </div>
                                <div class="c_current_address_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Street Name
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_street_name" name="c_street_name" class="form-control" value="<?php echo $abc2['c_street_name'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_email" class="form-control col" type="text" name="c_email" value="<?php echo $abc2['c_email'] ?>">
                                </div>
                                <div class="c_email_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Office</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_office" class="form-control col" type="text" name="c_office" value="<?php echo $abc2['c_office'] ?>">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Father's Name
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_father_name" name="c_father_name" class="form-control" value="<?php echo $abc2['c_father_name'] ?>">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Mother's Name
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="c_mother_name" name="c_mother_name" class="form-control" value="<?php echo $abc2['c_mother_name'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Husband/Wife
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_husorwife_name" name="c_husorwife_name" class="form-control" placeholder="Enter the name" type="text" value="<?php echo $abc2['c_husorwife_name'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Grandfather's Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_gfather_name" class="form-control col" type="text" name="c_gfather_name" value="<?php echo $abc2['c_gfather_name'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Father in law</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="c_fatherinlaw_name" class="form-control col" placeholder="Enter the  name" type="text" name="c_fatherinlaw_name" value="<?php echo $abc2['c_fatherinlaw_name'] ?>">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Image
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="c_photo" class="dropify" name="c_photo" data-default-file="../images/customers/<?php echo $abc2['c_photo'] ?>" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Citizenship Front
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="c_front_citizenship" class="dropify" name="c_front_citizenship" data-default-file="../images/customers/<?php echo $abc2['c_front_citizenship'] ?>" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Citizenship Back
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="c_back_citizenship" class="dropify" name="c_back_citizenship" data-default-file="../images/customers/<?php echo $abc2['c_back_citizenship'] ?>" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label col-md-6 col-sm-3 label-align">Assign to
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control select2" name="c_created_by" id="c_created_by">


                                        <?php
                                        if ($_SESSION['access_level'] == 'superadmin') {
                                            $adm = $pdo->prepare("SELECT * FROM admins a 
                                            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                                            INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='admin'");
                                            $adm->execute(['rname' => 'superadmin']);
                                            $admfet = $adm->fetchAll();
                                            $admcount = $adm->rowCount();
                                            if ($admcount > 0) {
                                                echo ' <optgroup label="Admins">';
                                                foreach ($admfet as $adm2) {
                                                    if ($adm2['a_id'] == $abc2['c_created_by']) {
                                                        echo '<option value="' . $adm2['a_id'] . '" selected>' . $adm2['a_fullname'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $adm2['a_id'] . '">' . $adm2['a_fullname'] . '</option>';
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                            $adm2 = $pdo->prepare("SELECT * FROM admins a 
                                            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                                            INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='staff'");
                                            $adm2->execute(['rname' => 'superadmin']);
                                            $admfet2 = $adm2->fetchAll();
                                            $admcount2 = $adm2->rowCount();
                                            if ($admcount2 > 0) {
                                                echo ' <optgroup label="Staff">';
                                                foreach ($admfet2 as $adm22) {
                                                    if ($adm22['a_id'] == $abc2['c_created_by']) {
                                                        echo '<option value="' . $adm22['a_id'] . '" selected>' . $adm22['a_fullname'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $adm22['a_id'] . '">' . $adm22['a_fullname'] . '</option>';
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                        } else if ($_SESSION['access_level'] == 'admin') {
                                            echo 'asd';
                                            $adm = $pdo->prepare("SELECT * FROM admins WHERE a_id=:a_id");
                                            $adm->execute(['a_id' => $_SESSION['id']]);
                                            $admfet = $adm->fetchAll();
                                            $admcount = $adm->rowCount();
                                            if ($admcount > 0) {
                                                echo ' <optgroup label="Admins">';
                                                foreach ($admfet as $adm2) {
                                                    if ($adm2['a_id'] == $abc2['c_created_by']) {
                                                        echo '<option value="' . $adm2['a_id'] . '" selected>' . $adm2['a_fullname'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $adm2['a_id'] . '">' . $adm2['a_fullname'] . '</option>';
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                        } else if ($_SESSION['access_level'] == 'staff') {
                                            $adm2 = $pdo->prepare("SELECT * FROM admins a 
                                            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                                            INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='staff'");
                                            $adm2->execute(['rname' => 'superadmin']);
                                            $admfet2 = $adm2->fetchAll();
                                            $admcount2 = $adm2->rowCount();
                                            if ($admcount2 > 0) {
                                                echo ' <optgroup label="Staff">';
                                                foreach ($admfet2 as $adm22) {
                                                    if ($adm22['a_id'] == $abc2['c_created_by']) {
                                                        echo '<option value="' . $adm22['a_id'] . '" selected>' . $adm22['a_fullname'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $adm22['a_id'] . '">' . $adm22['a_fullname'] . '</option>';
                                                    }
                                                }
                                                echo '</optgroup>';
                                            }
                                        } else {
                                            header('Location: permissiondenied.php');
                                        }
                                        ?>
                                    </select>
                                    <div class="c_creator_error"></div>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="col-md-12">
                                    <label for="middle-name" class="col-form-label col-md-6 label-align">Limitations *</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input id="c_limitations" class="form-control col" placeholder="Enter limitation" type="text" name="c_limitations" value="<?php echo $abc2['c_limitations'] ?>">
                                    </div>
                                    <div class="c_limitations_error"></div>
                                </div>
                            </div>

                        </div>



                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-12" style="display:flex;justify-content: flex-end;">
                                    <input type="hidden" readonly name="c_id" value="<?php echo $abc2['c_id']; ?>">
                                    <div class="relbtn">
                                        <button type='submit' id="regcus" class="btn btn-primary add">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- returns only number -->
<script>
    function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
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
    var nagchk = true;
    var citinum = $("#c_citizenship_number").val();
    $(document).on("keyup", "#c_citizenship_number", function() {

        var citichk = $(this).val();
        $(this).attr("maxlength", "14");
        if (citichk.length < 5) {
            $("#c_citizen_error").html("<p class='text text-danger'>The value must be greater than 10 digit</p>");
            $(this).focus();
            nagchk = false;
        } else {
            $.ajax({
                type: "POST",
                url: "other_controller/uniquechk.php",
                data: {
                    oldcitinum: citinum,
                    citichk: citichk,
                    action: 'chkcitizenforup'
                },
                success: function(data) {
                    if ($.trim(data) == '1') {
                        nagchk = true;
                        $("#c_citizen_error").html("<p class='text text-success'>It's OK</p>");
                    } else {
                        nagchk = false;
                        $("#c_citizen_error").html("<p class='text text-danger'>There is already another acount assigned</p>");
                    }
                }
            });
        }
    });
    $(document).on("click", "#regcus", function(e) {
        $(".relbtn").html('<button type="submit" id="regcus" class="btn btn-primary add" disabled><i class="fa fa-spinner fa-spin"></i> Processing</button>');
        e.preventDefault();
        var c_number = $("#c_number").val();
        var c_citizenship_number = $("#c_citizenship_number").val();
        var c_name = $("#c_name").val();
        var c_dob = $("#c_dob").val();
        var c_occupation = $("#c_occupation").val();
        var c_mobile = $("#c_mobile").val();
        var c_permanent_address = $("#c_permanent_address").val();
        var c_current_address = $("#c_current_address").val();
        var c_limitations = $("#c_limitations").val();
        var email = $("#c_email").val();
        var cnumvalidation = false;
        var ccitizenvalidation = false;
        var climitvalidation = false;
        var cnamevalidation = false;
        var dobvalidation = false;
        var ovalidation = false;
        var mvalidation = false;
        var cpavalidation = false;
        var evalidation = false;
        var ccavalidation = false;

        if (!validateEmail(email)) {

            $(".c_email_error").html("<p class='text text-danger'>Email is invalid</p>");
        } else {
            if ($.trim(email) == '') {
                $(".c_email_error").html("<p class='text text-danger'>Email is invalid</p>");
            } else {
                $(".c_email_error").html("<p class='text text-success'>Looks Good!</p>");
                evalidation = true;
            }
        }
        if ($.trim(c_created_by) == '') {
            $(".c_creator_error").html("<p class='text text-danger'>Creator must be assigned</p>");
        } else {
            $(".c_creator_error").html("<p class='text text-success'></p>");
            creatervalid = true;
        }
        if ($.trim(c_number) == '') {
            $(".c_number_error").html("<p class='text text-danger'>Customer number is empty</p>");
        } else {
            $(".c_number_error").html("<p class='text text-success'></p>");
            cnumvalidation = true;
        }
        if ($.trim(c_limitations) == '') {
            $(".c_limitations_error").html("<p class='text text-danger'>Customer Limitation is empty</p>");
        } else {
            $(".c_limitations_error").html("<p class='text text-success'></p>");
            climitvalidation = true;
        }
        if ($.trim(c_citizenship_number) == '') {
            $(".c_citizen_error").html("<p class='text text-danger'>Citizenship number cannot be null</p>");
        } else {
            if (nagchk == true) {
                $(".c_citizen_error").html("<p class='text text-success'></p>");
                ccitizenvalidation = true;
            } else {
                nagchk = false;
                ccitizenvalidation = false;
                $(".c_citizen_error").html("<p class='text text-danger'>Citizenship number already assigned</p>");
            }
        }
        if ($.trim(c_name) == '') {
            $(".c_name_error").html("<p class='text text-danger'>Customer name is empty</p>");
        } else {
            $(".c_name_error").html("<p class='text text-success'></p>");
            cnamevalidation = true;
        }
        if ($.trim(c_dob) == '') {
            $(".c_dob_error").html("<p class='text text-danger'>DOB Not Valid</p>");
        } else {
            $(".c_dob_error").html("<p class='text text-success'></p>");
            dobvalidation = true;
        }
        if ($.trim(c_occupation) == '') {
            $(".c_occupation_error").html("<p class='text text-danger'>Occupation is empty</p>");
        } else {
            $(".c_occupation_error").html("<p class='text text-success'></p>");
            ovalidation = true;
        }
        if ($.trim(c_mobile) == '') {
            $(".c_mobile_error").html("<p class='text text-danger'>Mobile Not Valid</p>");
        } else {
            $(".c_mobile_error").html("<p class='text text-success'></p>");
            mvalidation = true;
        }
        if ($.trim(c_permanent_address) == '') {
            $(".c_permanent_address_error").html("<p class='text text-danger'>Address is empty</p>");
        } else {
            $(".c_permanent_address_error").html("<p class='text text-success'></p>");
            cpavalidation = true;
        }
        if ($.trim(c_current_address) == '') {
            $(".c_current_address_error").html("<p class='text text-danger'>Address is empty</p>");
        } else {
            $(".c_current_address_error").html("<p class='text text-success'></p>");
            ccavalidation = true;
        }

        if (evalidation == true && creatervalid == true && climitvalidation == true && cnumvalidation == true && ccitizenvalidation == true && cnamevalidation == true && dobvalidation == true && ovalidation == true &&
            mvalidation == true && cpavalidation == true && ccavalidation == true) {
            var data = new FormData(document.getElementById("form1"));
            data.append("action", "update");
            $.ajax({
                type: "POST",
                url: "other_controller/editcustomer_controller.php",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    // $("#form1")[0].reset();
                    $(".relbtn").html('<button type="submit" id="regcus" class="btn btn-primary add">Update</button>');
                    pb.clear();
                    pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Registered Successfully');
                }
            });
        } else {
            $(".relbtn").html('<button type="submit" id="regcus" class="btn btn-primary add">Update</button>');
            pb.clear();
            pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Please fill all the forms correctly');
        }

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    });
</script>