<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST');
include '../libs/connect.php';
include_once '../../../classes/databasetable.php';
// header('content-type: application/json');
date_default_timezone_set("Asia/Kathmandu");
function tokenverify($token)
{
    $tab1 = new DatabaseTable('admins');
    $find1 = $tab1->find('a_token', $token);
    $udetail = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {
        if ($udetail['a_token_expiry'] > date('Y-m-d')) {
            return true;
        } else {
            session_start();
            session_destroy();
            $_SESSION['superadminloggedin'] = false;
            return false;
        }
    } else {
        return false;
    }
    // md5(uniqid($your_user_login, true));
}
function expirytokenverify($token)
{
    $tab1 = new DatabaseTable('admins');
    $find1 = $tab1->find('a_token', $token);
    $udetail = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {
        $expiry = strtotime($udetail['a_token_expiry']);
        $today = strtotime(date('Y-m-d H:i:s'));
        if ($expiry < $today) {

            createnewtoken($token);
            return true;
        } else {

            return false;
        }
    } else {
        return false;
    }
}
function createnewtoken($oldtoken)
{
    $tab1 = new DatabaseTable('admins');
    $find1 = $tab1->find('a_token', $oldtoken);
    $udetail = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {

        if ($udetail['a_token_expiry'] < date('Y-m-d')) {
            $newtoken = md5(uniqid());
            $today = date('Y-m-d H:i:s');
            $currentDate = strtotime($today);
            $futureDate = $currentDate + (60 * 60 * 24);
            $formatDate = date("Y-m-d H:i:s", $futureDate);
            $crit = [
                'a_token' => $newtoken,
                'a_token_expiry' => $formatDate,
                'a_id' => $udetail['a_id']
            ];
            $update = $tab1->update($crit, 'a_id');
        } else {
            return true;
        }
    }
}
function newinitialtoken($id)
{
    $tab1 = new DatabaseTable('admins');
    $find1 = $tab1->find('a_id', $id);
    $udetail = $find1->fetch();
    $counter = $find1->rowCount();
    if ($counter > 0) {
        $newtoken = md5(uniqid());
        $today = date('Y-m-d H:i:s');
        $currentDate = strtotime($today);
        $futureDate = $currentDate + (60 * 60 * 24);
        $formatDate = date("Y-m-d H:i:s", $futureDate);
        $crit = [
            'a_token' => $newtoken,
            'a_token_expiry' => $formatDate,
            'a_id' => $udetail['a_id']
        ];
        $update = $tab1->update($crit, 'a_id');
    }
}
