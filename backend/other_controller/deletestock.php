<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM stocks WHERE st_id = '.$_GET['did']);
