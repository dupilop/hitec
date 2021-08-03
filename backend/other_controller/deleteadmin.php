<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM admins WHERE a_id = '.$_GET['did']);
