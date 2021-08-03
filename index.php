<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {

    case '/login':
        require __DIR__ . '/login.php';
        break;
    case '/':
        require __DIR__ . '/login.php';
        break;

    case '/logout':
        require __DIR__ . '/logout.php';
        break;

    default:
        require __DIR__ . '/login.php';
        break;
}
// if ($_SERVER["HTTPS"] != "on") {
// header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
// exit();
// }
