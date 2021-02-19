<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM notifications WHERE n_id = ' . $_GET['did']);
