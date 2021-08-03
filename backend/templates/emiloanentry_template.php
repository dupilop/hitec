<?php
require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_loanentry', $pdo)) {
    header('Location: permissiondenied.php');
}
?>


<div id="reloadentry">

</div>
<script type="text/javascript">
    loadentry();

    function loadentry() {
        $("#reloadentry").html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            url: "other_controller/reloademiloanentry.php",
            method: "POST",
            data: {},
            success: function(data) {
                $('#reloadentry').html(data);
            }
        });
    }
    $(document).on("click", ".addservice", function() {
        // e.preventDefault();
        var lamt = $.trim($(this).parent().parent().parent().find(".amount").val());
        var serviceamt = $(this).parent().parent().parent().find(".servchargeamt").val();
        if ($(this).is(":checked")) {
            alert($(this).val());
            var newamt = parseFloat(lamt) + parseFloat(serviceamt);
        } else {
            alert($(this).val());
            var newamt = parseFloat(lamt);

        }
    })
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

    function convertDate(date) {
        var momentDate = moment(date).format('YYYY-MM-DD hh:mm:ss');
        return momentDate;
    }
    $(document).on("click", ".submitloanentry", function(e) {
        e.preventDefault();
        // alert($(this).parent().parent().html());
        var title = $(this).parent().parent().find(".title").val();

        var dpayment = $(this).parent().parent().find(".dpayment").val();
        var lperiod = $(this).parent().parent().find(".lperiod").val();
        var l_c_id = $(this).parent().parent().find(".l_c_id").val();
        var l_service_charge = $(this).parent().parent().find(".servchargeamt").val();
        var oamount = $(this).parent().parent().find(".amount").val();
        if ($(this).parent().parent().find(".addservice").is(":checked")) {
            var amount = parseFloat(oamount) + parseFloat(l_service_charge);
        } else {
            var amount = parseFloat(oamount);
        }
        var l_service_charge_chk = $(this).parent().parent().find(".addservice").val();
        var lupdatetime = $(this).parent().parent().find(".lupdatetime").val();
        lupdatetime = convertDate(lupdatetime);
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
                    l_upload_date_time: lupdatetime,
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