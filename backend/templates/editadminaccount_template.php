 <?php

    echo '<form class="" action="" autocomplete="off"  id="form2" method="post" novalidate>
                                       
                                        <span class="section">Admin Details</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="a_fullname" required="required" value="' . $a['a_fullname'] . '" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date of Birth<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class="date" type="date" value="' . $a['a_dob'] . '" name="a_dob" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class="optional" value="' . $a['a_position'] . '" name="a_position" data-validate-length-range="5,15" type="text" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align"> Mobile Number<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="number" class="number" name="a_mobile" data-validate-minmax="1000000000,10000000000" value="' . $a['a_mobile'] . '" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="number" class="number" name="a_phone"   data-validate-minmax="1000000000,10000000000" value="' . $a['a_phone'] . '" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Gender <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="text" class="number" name="a_gender" value="' . $a['a_gender'] . '"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea required="required"  name="a_address">' . $a['a_address'] . '</textarea></div>
                                        </div>
                                        
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="a_email" value="' . $a['a_email'] . '" class="email" required="required" type="email" /></div>
                                        </div>
                                      
                                        <div class="row">
                                            <div class="col-md-8 col-sm-2" style="display:flex;justify-content:flex-end;">
                                                <input type="hidden" name="a_id" value="' . $a['a_id'] . '">
                                                <button class="btn btn-outline-success resetpass">Reset Password</button>
                                                
                                            </div>
                                            <div class="col-md-4 col-sm-2">
                                                <button class="btn btn-outline-success" name="update"/>Update</button>
                                            </div>
                                        </div>
                                    </form>';
    echo '<div class="modal fade" id="resetpassmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Reset Password</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <form id="form1" method="post">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">New Password<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="password" name="a_password" id="a_password" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm Password<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="password" required="required" id="cpass" />   
                                            </div>
                                        </div>
                                        <input type="hidden" name="a_id" value="' . $a['a_id'] . '">
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-outline-primary chpass">Update</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>';
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
     $(document).on("click", ".resetpass", function(e) {
         e.preventDefault();
         $("#resetpassmodal").modal("show");
     });
     $(document).on("click", ".chpass", function(e) {
         e.preventDefault();
         $("#resetpassmodal").modal("hide");
         var p1 = $("#a_password").val();
         var p2 = $("#cpass").val();
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
                                 formdata.append('action', 'changeadminpassword');
                                 $.ajax({
                                     type: "POST",
                                     url: "./other_controller/changepassadmin_controller.php",
                                     data: formdata,
                                     contentType: false,
                                     context: this,
                                     processData: false,
                                     success: function(data) {
                                         $("#form1")[0].reset();
                                         pb.clear();
                                         pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Password Successfully Updated');
                                     }
                                 });
                             } else {
                                 pb.clear();
                                 pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Process Cancelled');
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
             pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Password doesnot match');
         }
     });
 </script>