<?php


// try {
//   $pdo = new PDO('mysql:dbname=hitecnepal;host=127.0.0.1', 'root', '');
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//   echo $e->getMessage();
// }

try {
    $pdo = new PDO('mysql:dbname=hitecnepal;host=127.0.0.1', 'hitecnepal', '87DZ3X2n8nssLYFJ');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }