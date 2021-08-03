<?php

require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_viewnotification', $pdo)) {
    header('Location: permissiondenied.php');
}

$abc = $pdo->prepare("SELECT * FROM admins a 
WHERE a_id=:a_id");
$abc->execute(['a_id' => $userid]);
$abcd = $abc->fetch();
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <h2 class="h3 mb-4 page-title">BULK SMS</h2>
            <div class="my-4">
                <ul class="nav nav-pills" id="pills-tab2" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link px-3 active" id="pills-contact-tab2" data-toggle="pill" href="#pills-contact2" role="tab" aria-controls="pills-contact" aria-selected="false">PUSH MESSAGE</a>
                    </li>

                </ul>
                <div class="tab-content mb-2" id="pills-tabContent2">

                    <div class="tab-pane fade show active" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact-tab2">
                        <hr class="my-4">
                        <form action="" id="form3" method="POST" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" name="n_text"></textarea>
                                    </div>
                                    <div class="messageerror"></div>
                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="assignedto">Send to</label>
                                        <select class="form-control" id="assignedto" name="assignedto">
                                            <optgroup label="Roles">
                                                <?php $gg = $pdo->prepare("SELECT * FROM roles WHERE NOT r_name='superadmin'");
                                                $gg->execute();
                                                $ggg = $gg->fetchAll();
                                                foreach ($ggg as $g) {
                                                    echo '<option value="' . $g['r_name'] . '">' . $g['r_name'] . '</option>';
                                                }
                                                ?>

                                            </optgroup>
                                            <optgroup label="Others">
                                                <?php
                                                echo '<option value="customer">Customers</option>';
                                                ?>

                                            </optgroup>

                                        </select>
                                    </div>
                                    <div class="relbtn">
                                    <button type="submit" class="btn btn-outline-primary" id="addbulkmess">Send</button>
                                        
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    load_data();

    function load_data() {
        $.ajax({
            url: "other_controller/pushnotification_controller.php",
            method: "POST",
            data: {
                action: "view"
            },
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }
    $(document).on("click", "#addbulkmess", function(e) {
        e.preventDefault();
        $(".relbtn").html('<button type="submit" class="btn btn-outline-primary" disabled id="addbulkmess">Sending...</button>');
        var text = $("#message").val();
        var assign = $("#assignedto").val();
        if ($.trim(text) != '') {
            $(".messageerror").html("<p style='color:green;'></p>");

            var ab3 = pb.prompt(

                function callback(value) {
                    var data = {
                        password: value
                    };
                    $.ajax({
                        type: "POST",
                        url: "other_controller/passwordcheck_controller.php",
                        data: data,

                        success: function(data) {
                            if ($.trim(data) == 'true') {
                                var formdata = new FormData(document.getElementById("form3"));
                                formdata.append('action', 'pushnotification');
                                $.ajax({
                                    type: "POST",
                                    url: "other_controller/bulkmessage_controller.php",
                                    data: formdata,
                                    contentType: false,
                                    context: this,
                                    processData: false,
                                    success: function(data) {
                                        console.log(data);
                                        pb.clear();
                                        pb.success('<span class="fe fe-16 fe-check-circle"></span> Messaged Pushed');
                                        $("#form3")[0].reset();
                                        $(".relbtn").html('<button type="submit" class="btn btn-outline-primary" id="addbulkmess">Send</button>');
                                        load_data();
                                    }
                                });
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
            $(".messageerror").html("<p style='color:red;'>Message text is empty</p>");
             $(".relbtn").html('<button type="submit" class="btn btn-outline-primary" id="addbulkmess">Send</button>');
        }

    });
 
</script>