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
                                    <form class="" action="" method="post" enctype="multipart/form-data" novalidate>
                                       
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Fullname<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="1" name="a_fullname" value="<?php  echo $abc['a_fullname']; ?>" required="required" />
                                            </div>
                                        </div>
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Department<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='optional' name="a_department" data-validate-length-range="5,15" value="<?php  echo $abc['a_department']; ?>"  type="text" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="a_email" value="<?php  echo $abc['a_email']; ?>"  class='email' required="required" type="email" /></div>
                                        </div>
                                        <div class="field item form-group">
                                          <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                          <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="password" id="password1" name="a_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" value="<?php echo $abc['a_password']; ?>" required />
                                            
                                            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                              <i id="slash" class="fa fa-eye-slash"></i>
                                              <i id="eye" class="fa fa-eye"></i>
                                            </span>
                                          </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea required="required"  name="a_address"><?php echo $abc['a_address']; ?></textarea></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Profile<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="file" class="form-control" name="a_new_profile_image"  />
                                                 <input name="a_profile_image" value="<?php  echo $abc['a_profile_image']; ?>"  type="hidden" />

                                            </div>
                                        </div>
                                        
                                       
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <input type="hidden" name="a_id" value="<?php  echo $abc['a_id']; ?>">
                                                    <button type='submit' name="update" class="btn btn-primary">Update</button>
                                                    <button type='reset' class="btn btn-success">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="x_content bs-example-popovers">

                                          <div class="alert alert-danger alert-dismissible " role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Notice!</strong> Don't change password and image field if you don't need
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