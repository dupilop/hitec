 <?php 

 echo '<form class="" action="" autocomplete="off"  id="form2" method="post" novalidate>
                                       
                                        <span class="section">Admin Details</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="a_fullname" required="required" value="'.$a['a_fullname'].'" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date of Birth<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class="date" type="date" value="'.$a['a_dob'].'" name="a_dob" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Position<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class="optional" value="'.$a['a_position'].'" name="a_position" data-validate-length-range="5,15" type="text" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align"> Mobile Number<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="number" class="number" name="a_mobile" data-validate-minmax="1000000000,10000000000" value="'.$a['a_mobile'].'" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Phone Number<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="number" class="number" name="a_phone"   data-validate-minmax="1000000000,10000000000" value="'.$a['a_phone'].'" required="required"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Gender <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="text" class="number" name="a_gender" value="'.$a['a_gender'].'"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea required="required"  name="a_address">'.$a['a_address'].'</textarea></div>
                                        </div>
                                        
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="a_email" value="'.$a['a_email'].'" class="email" required="required" type="email" /></div>
                                        </div>
                                         <div class="field item form-group">
                                          <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                          <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="password" id="password1" name="a_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" value="'.$a['a_password'].'" required />
                                            
                                            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                              <i id="slash" class="fa fa-eye-slash"></i>
                                              <i id="eye" class="fa fa-eye"></i>
                                            </span>
                                          </div>
                                        </div>
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm password<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="password"  value="'.$a['a_password'].'" data-validate-linked="password" required="required" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <div class="col-md-9 col-sm-2">
                                            <input type="hidden" name="a_id" value="'.$a['a_id'].'">
                                                <input class="form-control btn btn-success" name="update" value="Update" type="submit" style="float: right;width:10%;"/></div>
                                        </div>
                                    </form>';
?>
 <script src="../vendors/validator/multifield.js"></script>
    <script src="../vendors/validator/validator.js"></script>
<script>
        function hideshow(){
            var password = document.getElementById("password1");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");
            
            if(password.type === 'password'){
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            }
            else{
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";
            }

        }
    </script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {  
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>  