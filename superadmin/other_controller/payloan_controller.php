<?php
require '../../db/connect.php';
require '../../classes/databasetable.php';
$abc = new DatabaseTable('loan_transactions');
$abc2 = new DatabaseTable('loans');
if (isset($_POST)) {
    // print_r($_POST);
    $rem_amt = $_POST['total_new_remaining_amount'];
    unset($_POST['pay'], $_POST['total_new_remaining_amount']);
    $_POST['lt_month'] = date("m");
    $_POST['lt_year'] = date("Y");
    $_POST['lt_uploaddate'] = date("Y-m-d H:i:sa");
    $ins = $abc->insert($_POST);

    $criteria = [
        'l_remaining_loan' => $rem_amt,
        'l_id' => $_POST['lt_l_id']
    ];
    $ins = $abc2->update($criteria, 'l_id');
}
echo $_POST['lt_l_id'];
