<?php
require "../../db/connect.php";

$dcust = $pdo->query('DELETE FROM salarys WHERE sal_id = ' . $_GET['did']);
