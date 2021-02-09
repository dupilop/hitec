<?php 
session_start();
require "../../db/connect.php"; 
$uprr = $pdo->prepare("UPDATE notifications SET n_status='old', n_visibility='yes' WHERE n_status='new' && (n_receiver='all' || n_receiver='superadmin')");
	$uprr->execute();
