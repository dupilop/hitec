<?php
global $currentusertype;
$currentusertype = 'PROD';
// $currentusertype = 'PROD';
if ($currentusertype == 'DEV') {
    $baseurl = 'http://localhost/hitecs/';
} else {
    $baseurl = 'https://hitecnepal.com/';
}

$baseapiurl = $baseurl . 'backend/api/';

$customerregister = $baseapiurl . 'customers/registration.php';

//admin login
$adminlogin = $baseapiurl . 'authentication/adminlogin.php';
