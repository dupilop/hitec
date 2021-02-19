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
                    <h2>Notification</h2>
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
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="n_text" required="required" />
                                <input type="hidden" name="u_type" value="superadmin">
                                <input type="hidden" name="n_status" value="new">
                                <input type="hidden" name="u_id" value="<?php echo $userid;  ?>">
                            </div>
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Receiver<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" name="n_receiver">
                                    <option value="all">All</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
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
            url: "other_controller/viewnotification.php",
            method: "POST",
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }
    $(document).on('submit', '#form1', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "other_controller/addnotification.php",
            data: new FormData(document.getElementById("form1")),
            contentType: false,
            processData: false,
            success: function(data) {
                $("#form1")[0].reset();
                load_data();
                loading_data2();
                var cc = 0;
            }
        });
    });
    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $("#myModal" + id).modal('show');
    });
    $(document).on('click', '.delete', function() {
        var id = $(this).attr('id');
        var data = 'id=' + id;
        $.ajax({
            type: "GET",
            url: "other_controller/deletenotification.php?did=" + id,
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
                load_data();
                loading_data2();
                pb.clear();
                pb.error('<i class="fa fa-trash fa-lg" aria-hidden="true"></i>   Deleted Successfully');

            }
        });

    });
</script>