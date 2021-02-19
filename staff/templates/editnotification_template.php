 <?php 

 echo '<form class="" action="" autocomplete="off"  id="form2" method="post" novalidate>
                                       
                                        <span class="section">Admin Details</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="1" name="n_text" required="required" value="'.$a['n_text'].'" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Receiver<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select name="n_receiver" class="form-control">';
                                                if($a['n_receiver'] == 'All'){
                                                    echo '<option selected>All</option>';
                                                    echo '<option>Admin</option>';
                                                    echo '<option>Staff</option>';
                                                }elseif($a['n_receiver'] == 'Admin'){
                                                    echo '<option>All</option>';
                                                    echo '<option selected>Admin</option>';
                                                    echo '<option>Staff</option>';
                                                }else{
                                                    echo '<option>All</option>';
                                                    echo '<option>Admin</option>';
                                                    echo '<option selected>Staff</option>';
                                                }
                                                echo '</select>    
                                            </div>
                                        </div>
                                      
                                        
                                       
                                        <div class="field item form-group">
                                            <div class="col-md-9 col-sm-2">
                                            <input type="hidden" name="n_id" value="'.$a['n_id'].'">
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