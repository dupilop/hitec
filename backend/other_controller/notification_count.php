<?php
require "../../db/connect.php";  //include the DB config file
  $rr = $pdo->prepare("SELECT * FROM notifications WHERE n_status='new' && (n_receiver='all' || n_receiver='superadmin') ORDER BY n_id DESC");
  $rr->execute();
  $result = $rr->fetchAll();

  $total_row = $rr->rowCount();
  $output = $total_row;
  if($total_row>0){
    echo $output;
    
  }
