<?php
// require '../../classes/databasetable.php';
$tab1 = new DatabaseTable('loans');
$lid = $_GET['lid'];
$abc = $pdo->prepare("SELECT * FROM loans WHERE l_id=:lid");
$abc->execute(['lid' => $lid]);
$abc2 = $abc->fetch();

if (isset($_POST['update'])) {
    unset($_POST['update']);
    if ($_POST['l_upload_date_time'] == '') {
        unset($_POST['l_upload_date_time']);
    }
    $up1 = $tab1->update($_POST, 'l_id');
    // print_r($_POST);
    header("Location: loans");
}

$title = 'Edit Loan';
$content = loadTemplate('templates/editloan_template.php', ['abc2' => $abc2]);
