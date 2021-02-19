<?php
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';


?>
<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-envelope-o"></i>
  <?php
  $rr = $pdo->prepare("SELECT * FROM notifications WHERE n_status='new' && n_visibility='yes' && (n_receiver='all' || n_receiver='superadmin')  ORDER BY n_id DESC");
  $rr->execute();
  $result = $rr->fetchAll();

  $total_row = $rr->rowCount();
  $output = $total_row;
  if ($total_row > 0) {
  ?>
    <span class="badge bg-green"><?php echo $total_row;  ?></span>

  <?php

  } else {
    echo '<span class="badge bg-green">0</span>';
  }
  ?>
</a>


<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
  <?php
  $ss = $pdo->prepare("SELECT * FROM notifications WHERE (n_receiver='all' || n_receiver='superadmin')");
  $ss->execute();
  $rc = $ss->rowCount();
  if ($rc > 0) {

    foreach ($ss as $rrr) {
  ?>
      <li class="nav-item">
        <a class="dropdown-item" href="profile">
          <span class="image"><img src="../../images/bell.png" alt="Profile Image" /></span>
          <span>
            <span><?php echo $rrr['u_type'];  ?></span>
            <?php


            ?>
            <span class="time"><?php echo $rrr['n_date']; ?></span>
          </span>
          <span class="message">
            <?php echo $rrr['n_text']; ?>
          </span>
        </a>
      </li>

  <?php
    }
  } else {
    echo '<li class="nav-item">';
    echo 'No new notifications</li>';
  }

  ?>
  <li class="nav-item">
    <div class="text-center">
      <a class="dropdown-item" href="profile">
        <strong>See All Alerts</strong>
        <i class="fa fa-angle-right"></i>
      </a>
    </div>
  </li>
</ul>
<script type="text/javascript">
  $("#navbarDropdown1").on("click", function() {
    $(".bg-green").html("0");
    $.ajax({
      url: "other_controller/removenotificationcount.php",
      method: "POST",
      success: function(data) {}
    });
  });
</script>