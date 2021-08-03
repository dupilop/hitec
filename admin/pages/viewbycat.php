<?php
$cat = new DatabaseTable('category');
$date = new DateTime();
$categoryId = $_GET['id'];
$date->format('Y-m-d');
$date = date('Y-m-d');
$stmt = $pdo->prepare("SELECT * FROM job WHERE categoryId = '$categoryId' && closingDate > '$date'");
$stmt2 = $cat->find('id', $categoryId);
$stmt->execute();
$title = 'Home Page';
$content = loadTemplate('templates/viewbycat_template.php', ['stmt' => $stmt, 'stmt2' => $stmt2]);
