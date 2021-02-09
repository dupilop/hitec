<?php
require '../db/connect.php';
$userid2 = $_SESSION['id'];
$sql2 = "SELECT * FROM superadmins WHERE sa_id='$userid2'";
$abc2 = $pdo->prepare($sql2);
$abc2->execute();
$dat2 = $abc2->fetch();

$dat3 = $pdo->query("SELECT * FROM notifications");
?>




<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Profile Overview</h2>
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

        <div class="col-md-3 col-sm-3  profile_left">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              <?php
              if ($dat2['sa_profile_image'] == '') {
                echo '<img class="img-responsive avatar-view" src="../images/logo/hitechvision.jpg" width="100px" height="100px" alt="Avatar" title="Change the avatar">';
              } else {
                echo '<img class="img-responsive avatar-view" src="../images/profile/' . $dat2['sa_profile_image'] . '" width="100px" height="100px" alt="Avatar" title="Change the avatar" style="border-radius: 50%;">';
              }

              ?>

            </div>
          </div>
          <h3><?php echo $dat2['sa_username']; ?></h3>

          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $dat2['sa_company_location']; ?>
            </li>

            <li>
              <i class="fa fa-building" aria-hidden="true"></i> <?php echo $dat2['sa_company_name']  ?>
            </li>
            <li>
              <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $dat2['sa_email']  ?>
            </li>
          </ul>

          <a class="btn btn-secondary" href="editprofile" style="color:white;background: #2a3f54;"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
          <br />


          <!-- end of skills -->

        </div>

        <div class="col-md-9 col-sm-9 ">

          <!-- start of user-activity-graph -->

          <!-- end of user-activity-graph -->

          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Notification</a>
              </li>


            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                <!-- start recent activity -->
                <ul class="messages">
                  <?php

                  foreach ($dat3 as $vv) {
                    $id = $vv['u_id'];
                    if ($vv['u_type'] == 'admin') {

                      $addat = $pdo->query("SELECT * FROM admins WHERE a_id='$id'")->fetch();
                      $ema = $addat['a_email'];
                    } else if ($vv['u_type'] == 'staff') {
                      $addat = $pdo->query("SELECT * FROM staffs WHERE s_id='$id'")->fetch();
                      $ema = $addat['s_email'];
                    } else {
                      $addat = $pdo->query("SELECT * FROM superadmins WHERE sa_id='$id'")->fetch();
                      $ema = $addat['sa_email'];
                    }
                  ?>
                    <li>
                      <img src="../images/bell.png" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <span class="badge badge-warning"><?php echo $vv['n_status'];  ?></span>
                        <p class="month"><?php echo $vv['n_date'];   ?></p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">To <?php echo $vv['n_receiver'];  ?></h4>
                        <blockquote class="message"><?php echo $vv['n_text']; ?></blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="#"><i class="fa fa-user"></i> By <?php echo '<b style="color:red;">' . $ema . '</b> (' . $vv['u_type'] . ')'; ?></a>
                        </p>
                      </div>
                    </li>


                  <?php } ?>
                </ul>
                <!-- end recent activity -->

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>