<?php
require "../../db/connect.php";  
require './sendmessagenotice.php';
if (isset($_POST['action']) && $_POST['action'] == 'pushnotification') {
    $arr = [];
    $n_text = $_POST['n_text'];
    if ($_POST['assignedto'] == 'admin' || $_POST['assignedto'] == 'staff') {
        $abc = $pdo->prepare("SELECT * FROM admins a
        INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id 
        INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:rname");
        $abc->execute(['rname' => $_POST['assignedto']]);
        foreach($abc as $abc2){
            array_push($arr, $abc2['a_mobile']);
        }
    } else if ($_POST['assignedto'] == 'customer') {
        $abc = $pdo->prepare("SELECT * FROM customers");
        $abc->execute();
        foreach($abc as $abc2){
            array_push($arr, $abc2['c_mobile']);
        }
    } else {
    }

    $arr2 = array_unique($arr);
foreach ($arr2 as $res_phone) {

        $send_res = sendmessage('3b83171c6652431626034ba629539855a8edb93d49b058738367a07956978dda', $res_phone, $n_text);
    
}
}
