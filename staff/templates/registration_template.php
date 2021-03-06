<?php

require('../db/connect.php');
$userid = $_SESSION['id'];
?>

<div class="">

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Customer Registration</h2>
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
                  <input type="text" id="c_number" name="c_number" class="form-control">
                </div>
                <div class="c_number_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Citizenship Number<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_citizenship_number" onkeypress="return onlyNumberKey(event)" name="c_citizenship_number" class="form-control" placeholder="Enter unique number">
                </div>
                <div class="c_citizen_error" id="c_citizen_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_name" name="c_name" class="form-control  ">
                </div>
                <div class="c_name_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_dob" name="c_dob" class="date-picker form-control" type="date">
                </div>
                <div class="c_dob_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Occupation <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_occupation" name="c_occupation" class="form-control ">
                </div>
                <div class="c_occupation_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Mobile Number<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_mobile" class="form-control col" type="text" name="c_mobile">
                </div>
                <div class="c_mobile_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Phone Number</label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_phone" class="form-control col" type="text" name="c_phone">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Gender</label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="form-control" name="c_gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Others</option>
                  </select>

                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Permanent Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_permanent_address" name="c_permanent_address" class="form-control  ">
                </div>
                <div class="c_permanent_address_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Current Address<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_current_address" name="c_current_address" class="form-control" type="text">
                </div>
                <div class="c_current_address_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Street Name
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_street_name" name="c_street_name" class="form-control ">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Email <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_email" class="form-control col" type="text" name="c_email">
                </div>
                <div class="c_email_error"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Office</label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_office" class="form-control col" type="text" name="c_office">
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="first-name">Father's Name
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_father_name" name="c_father_name" class="form-control">
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align" for="last-name">Mother's Name
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="c_mother_name" name="c_mother_name" class="form-control ">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Husband/Wife
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_husorwife_name" name="c_husorwife_name" class="form-control" placeholder="Enter the name" type="text">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Grandfather's Name</label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_gfather_name" class="form-control col" type="text" name="c_gfather_name">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="middle-name" class="col-form-label col-md-6 col-sm-3 label-align">Father in law</label>
                <div class="col-md-6 col-sm-6 ">
                  <input id="c_fatherinlaw_name" class="form-control col" placeholder="Enter the  name" type="text" name="c_fatherinlaw_name">
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Image
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="file" id="c_photo" class="dropify" name="c_photo" />
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Citizenship Front
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="file" id="c_front_citizenship" class="dropify" name="c_front_citizenship" />
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Citizenship Back
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="file" id="c_back_citizenship" class="dropify" name="c_back_citizenship" />
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-md-6 col-sm-3 label-align">Assign to *
                </label>
                <div class="col-md-6 col-sm-6">
                  <select class="form-control select2" name="c_created_by" id="c_created_by">
                    <option value="">Choose One</option>
                    <?php
                    $adm = $pdo->prepare("SELECT * FROM admins a 
                    INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                    INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='admin'");
                    $adm->execute(['rname' => 'superadmin']);
                    $admfet = $adm->fetchAll();
                    print_r($admfet);
                    $admcount = $adm->rowCount();
                    if ($admcount > 0) {
                      echo ' <optgroup label="Admins">';
                      foreach ($admfet as $adm2) {
                        echo '<option value="' . $adm2['a_id'] . '">' . $adm2['a_fullname'] . '</option>';
                      }
                      echo '</optgroup>';
                    }
                    $adm2 = $pdo->prepare("SELECT * FROM admins a 
                    INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
                    INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE NOT r.r_name=:rname AND r.r_name='staff'");
                    $adm2->execute(['rname' => 'superadmin']);
                    $admfet2 = $adm2->fetchAll();
                    print_r($admfet2);
                    $admcount2 = $adm2->rowCount();
                    if ($admcount2 > 0) {
                      echo ' <optgroup label="Staff">';
                      foreach ($admfet2 as $adm22) {
                        echo '<option value="' . $adm22['a_id'] . '">' . $adm22['a_fullname'] . '</option>';
                      }
                      echo '</optgroup>';
                    }
                    ?>

                  </select>
                  <div class="c_creator_error"></div>

                </div>
                <div class="form-group col-md-12">
                  <div class="col-md-12">
                    <label for="middle-name" class="col-form-label col-md-6 label-align">Limitations *</label>
                    <div class="col-md-6 col-sm-6">
                      <input id="c_limitations" class="form-control col" placeholder="Enter limitation" type="text" name="c_limitations">
                    </div>
                    <div class="c_limitations_error"></div>
                  </div>
                </div>
              </div>


            </div>



            <div class="ln_solid">
              <div class="form-group">
                <div class="col-md-12" style="display:flex;justify-content: flex-end;">
                  <div class="relbtn">
                    <button type='submit' id="regcus" class="btn btn-primary add">Add</button>
                  </div>
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
<!-- returns only number -->
<script>
  function onlyNumberKey(evt) {

    // Only ASCII charactar in that range allowed 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
    return true;
  }
  $('.select2').select2({
    theme: 'bootstrap4',
  });
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
  var nagchk = false;
  $(document).on("keyup", "#c_citizenship_number", function() {

    var citichk = $(this).val();
    $(this).attr("maxlength", "14");
    if (citichk.length < 5) {
      $("#c_citizen_error").html("<p class='text text-danger'>The value must be greater than 5 digit</p>");
      $(this).focus();
      nagchk = false;
    } else {
      $.ajax({
        type: "POST",
        url: "other_controller/uniquechk.php",
        data: {
          citichk: citichk,
          action: 'chkcitizen'
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
    var email = $("#c_email").val();
    var c_created_by = $("#c_created_by").val();
    var c_limitations = $("#c_limitations").val();
    var cnumvalidation = false;
    var climitvalidation = false;
    var ccitizenvalidation = false;
    var cnamevalidation = false;
    var dobvalidation = false;
    var ovalidation = false;
    var mvalidation = false;
    var cpavalidation = false;
    var evalidation = false;
    var ccavalidation = false;
    var creatervalid = false;
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
    if ($.trim(c_created_by) == '') {
      $(".c_creator_error").html("<p class='text text-danger'>Creator must be assigned</p>");
    } else {
      $(".c_creator_error").html("<p class='text text-success'></p>");
      creatervalid = true;
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

    if (evalidation == true && climitvalidation == true && creatervalid == true && cnumvalidation == true && ccitizenvalidation == true && cnamevalidation == true && dobvalidation == true && ovalidation == true &&
      mvalidation == true && cpavalidation == true && ccavalidation == true) {
      $.ajax({
        type: "POST",
        url: "other_controller/register.php",
        data: new FormData(document.getElementById("form1")),
        contentType: false,
        processData: false,
        success: function(data) {
          $("#form1")[0].reset();
          $(".relbtn").html('<button type="submit" id="regcus" class="btn btn-primary add">Add</button>');
          $("#staff").hide();
          $("#admin").hide();
          pb.clear();
          pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Registered Successfully');
        }
      });
    } else {
      $(".relbtn").html('<button type="submit" id="regcus" class="btn btn-primary add">Add</button>');
      pb.clear();
      pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Please fill all the forms correctly');
    }

    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test($email);
    }
  });
</script>