<?php
session_start();
require "../../db/connect.php";  //include the DB config file
require '../../classes/databasetable.php';


?>
<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-envelope-o"></i>
  <?php
  if ($_SESSION['access_level'] == 'superadmin') {
    $rr = $pdo->prepare("SELECT * FROM notifications n
  INNER JOIN notification_status ns ON n.n_id=ns.n_id WHERE ns_status='unread'");
    $rr->execute();
    $result = $rr->fetchAll();

    $total_row = $rr->rowCount();
    $output = $total_row;
  } else if ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'staff') {
    $rr = $pdo->prepare("SELECT * FROM notifications n
  INNER JOIN notification_status ns ON n.n_id=ns.n_id WHERE ns_status='unread' && ns_ad_id=:adid");
    $rr->execute(['adid' => $_SESSION['id']]);
    $result = $rr->fetchAll();

    $total_row = $rr->rowCount();
    $output = $total_row;
  } else {
  }
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
  if ($_SESSION['access_level'] == 'superadmin') {
    $ss = $pdo->prepare("SELECT * FROM notifications n
  INNER JOIN notification_status ns ON n.n_id=ns.n_id
  INNER JOIN admins a ON ns.ns_ad_id=a.a_id");
    $ss->execute();
    $rc = $ss->rowCount();
  } else if ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'staff') {
    $ss = $pdo->prepare("SELECT * FROM notifications n
  INNER JOIN notification_status ns ON n.n_id=ns.n_id
  INNER JOIN admins a ON ns.ns_ad_id=a.a_id WHERE ns.ns_ad_id=:adid");
    $ss->execute(['adid' => $_SESSION['id']]);
    $rc = $ss->rowCount();
  } else {
  }
  if ($rc > 0) {

    foreach ($ss as $rrr) {
  ?>
      <li class="nav-item">
        <a class="dropdown-item" href="profile">
          <span class="image"><img src="../images/bell.png" alt="Profile Image" /></span>
          <span>
            <span><?php echo $rrr['a_fullname'];  ?></span>
            <span class="time"><?php echo $rrr['n_uploaddate']; ?></span>
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