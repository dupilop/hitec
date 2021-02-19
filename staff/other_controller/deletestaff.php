<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM staffs WHERE s_id = '.$_GET['did']);
