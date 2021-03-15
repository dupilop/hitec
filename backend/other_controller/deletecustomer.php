<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM customers WHERE c_id = '.$_GET['did']);
