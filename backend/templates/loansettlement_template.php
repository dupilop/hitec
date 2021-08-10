<?php
require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_emisettlement', $pdo)) {
    header('Location: permissiondenied.php');
}

?>
<div id="reloadentry">

</div>
<div class="modal fade" id="printmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="printme">Print</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body printbody" id="printbody">

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    loadentry();

    function loadentry() {
        $("#reloadentry").html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            url: "other_controller/reloadsettlement.php",
            method: "POST",
            data: {},
            success: function(data) {
                $('#reloadentry').html(data);
            }
        });
    }

    function printElement(elem) {
        var domClone = elem.cloneNode(true);

        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }

        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }
    $(document).on("click", ".printme", function(e) {
        e.preventDefault();
        printElement(document.getElementById("invoice"));
    })
    $(document).on("click", ".mprint", function(e) {
        e.preventDefault();
        var id = $(this).attr("id");
        $("#printmodal").modal("show");
        $.ajax({
            url: "./other_controller/printsettlement.php",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $("#printbody").html(data);

            }
        })
    });

    $(document).on("click", ".msettle", function(e) {
        e.preventDefault();
        var id = $(this).attr("id");

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
                            $.ajax({
                                type: "POST",
                                url: "./other_controller/makesettle_controller.php",
                                data: {
                                    l_id: id,
                                    action: "settle"
                                },
                                success: function(data) {
                                    console.log(data);
                                    loadentry();
                                    pb.clear();
                                    pb.success('<span class="fe fe-16 fe-check-circle"></span>Settled Successfully');
                                }
                            });
                        } else {
                            loadentry();
                            alert('Invalid password');
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
    });
    $(document).on("keyup", ".servchargeper", function() {
        var per = $(this).val();
        var lamt = $.trim($(this).parent().parent().parent().find(".amount").val());
        var damt = $.trim($(this).parent().parent().parent().find(".dpayment").val());
        var remamt = lamt - damt;
        // alert(remamt);
        var pamt = (remamt * per) / 100;
        $(this).parent().parent().parent().find(".servchargeamt").val(pamt);
    });
    $(document).on("keyup", ".amount", function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().find(".servchargeamt").val(0);
        $(this).parent().parent().parent().find(".servchargeper").val(0);
        var lamt = parseFloat($(this).val());
        $(this).val(lamt);
        var climit = $.trim($(this).parent().parent().parent().find(".llimit").val());
        // alert(climit);
        // alert(lamt);
        // $(".rlimit").val(rlimit);
        if (isNaN(lamt)) {
            $(this).val(0);
            var rlimit = climit;
            $(".rlimit").val(rlimit);
        } else {
            if (lamt > climit) {
                $(this).val(climit);
                // alert('asd');
                $(".rlimit").val(0);
            } else {
                var rlimit = climit - lamt;
                $(".rlimit").val(rlimit);
            }
        }
    });
    $(document).on("click", ".submitloanentry", function(e) {
        e.preventDefault();
        // alert($(this).parent().parent().html());
        var title = $(this).parent().parent().find(".title").val();

        var amount = $(this).parent().parent().find(".amount").val();
        var dpayment = $(this).parent().parent().find(".dpayment").val();
        var lperiod = $(this).parent().parent().find(".lperiod").val();
        var l_c_id = $(this).parent().parent().find(".l_c_id").val();
        var l_service_charge = $(this).parent().parent().find(".servchargeamt").val();
        var tvalidation = false;
        var avalidation = false;
        var dvalidation = false;
        var lvalidation = false;
        if ($.trim(title) == '') {
            $(".titleerror").html("<p class='text text-danger'>Title is empty</p>");
        } else {
            $(".titleerror").html("<p class='text text-success'></p>");
            tvalidation = true;
        }
        if ($.trim(amount) == '') {
            $(".amounterror").html("<p class='text text-danger'>Amount is empty</p>");
        } else {
            $(".amounterror").html("<p class='text text-success'></p>");
            avalidation = true;
        }
        if ($.trim(dpayment) == '') {
            $(".dpaymenterror").html("<p class='text text-danger'>Amount is empty</p>");
        } else {
            $(".dpaymenterror").html("<p class='text text-success'></p>");
            dvalidation = true;
        }
        if ($.trim(lperiod) == '') {
            $(".lperioderror").html("<p class='text text-danger'>Loan Period cannot be empty</p>");
        } else {
            $(".lperioderror").html("<p class='text text-success'></p>");
            lvalidation = true;
        }
        if (tvalidation == true && avalidation == true && dvalidation == true && lvalidation == true) {
            $.ajax({
                type: "POST",
                url: "other_controller/emiloanentry_controller.php",
                data: {
                    l_title: title,
                    l_amount: amount,
                    l_down_payment: dpayment,
                    l_period: lperiod,
                    l_c_id: l_c_id,
                    l_service_charge: l_service_charge,
                    action: 'addloan'
                },
                success: function(data) {
                    loadentry();
                    pb.clear();
                    pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Loan Added Successfully');
                }
            });
        } else {
            alert("Some field is empty");
        }
    });
</script>