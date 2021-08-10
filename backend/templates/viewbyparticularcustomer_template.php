<?php
require '../db/connect.php';
require_once('other_controller/permission_controller.php');
$userid = $_SESSION['id'];
$per = new permission;
if (!$per->permit('p_savingreport', $pdo)) {
    header('Location: permissiondenied.php');
}

?>


<div class="row">
    <div class="col-md-6" style="display: flex;justify-content: flex-end;">

    </div>
    <div class="col-md-6" style="display: flex;justify-content: flex-end;">
        <input type="date" name="date" class="form-control m-2" id="sdate">
        <button class="btn btn-sm btn-outline-primary m-2 search">Search</button>
        <button class="btn btn-sm btn-outline-danger m-2 reset">Reset</button>
    </div>
</div>

<div class="user_data">

</div>
<script type="text/javascript">
    load_data('');
    // alert(id);

    function load_data(date) {
        var id = "<?php echo $_GET['cid']; ?>";
        $(".user_data").html('<i class="fa fa-spinner fa-spin fa-2x">');
        $.ajax({
            url: "other_controller/searchbysinglecustomer_controller.php",
            method: "POST",
            data: {
                id: id,
                sdate: date
            },
            success: function(data) {
                $('.user_data').html(data);
            }
        });
    }
    $(document).on("click", ".search", function() {
        var sdate = $("#sdate").val();
        load_data(sdate);
    });
    $(document).on("click", ".reset", function() {
        $("#sdate").val('');
        load_data('');
    });
</script>