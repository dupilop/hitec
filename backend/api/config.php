<?php
global $currentusertype;
$currentusertype = 'PROD';
// $currentusertype = 'PROD';

if ($currentusertype == 'DEV') {
    $baseurl = 'http://localhost/hitecs/backend/api/';
} else {
    $baseurl = 'https://hitecnepal.com/backend/api/';
}


$customerimageurl = $baseurl . 'images/customers/';
$customernoimage = $baseurl . 'images/noimage.jpg';
