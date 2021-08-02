<?php
session_start();
require "../../db/connect.php";
$uprr = $pdo->prepare("UPDATE notification_status SET ns_status='read' WHERE ns_ad_id=:aid");
$uprr->execute(['aid' => $_SESSION['id']]);
