<?php

if ((isset($_GET['principal']) && isset($_GET['interest']) && isset($_GET['paymonth']) && isset($_GET['loandate']))) {
    $principal = $_GET['principal'];
    $interest = $_GET['interest'];
    $paymonth = $_GET['paymonth'];
    $loandate = $_GET['loandate'];
    $monthly_principal = $principal / $paymonth;
    $monthly_interest = ($monthly_principal * $interest) / 100;
    $total_monthly_payment = $monthly_interest + $monthly_principal;
}
