<?php

require('../db/connect.php');
if (isset($_GET['did']) && $_GET['status'] == 'delete') {
  // $dcust = $pdo->query('DELETE FROM customers WHERE c_id = '.$_GET['did']);


}
?>

<div id="user_data">

</div>

<script type="text/javascript">
  load_data();

  function load_data() {
    $("#user_data").html('<i class="fa fa-spinner fa-spin fa-2x">');
    $.ajax({
      url: "other_controller/viewcustomer.php",
      method: "POST",
      success: function(data) {
        $('#user_data').html(data);
      }
    });
  }
</script>