<?php

// $baseurl = 'http://localhost/hitecs/';
$baseurl = 'https://hitecnepal.com/';
$baseapiurl = $baseurl . 'backend/api/';

$customerregister = $baseapiurl . 'customers/registration.php';

//admin login
$adminlogin = $baseapiurl . 'authentication/adminlogin.php';
?>
<script>
    // const baseurl = 'http://localhost/hitecs/';
    const baseurl = 'https://hitecnepal.com/';
    const baseapiurl = baseurl + 'backend/api/';

    const customerregister = baseapiurl + 'customers/registration.php';

    //admin login
    const adminlogin = baseapiurl + 'authentication/adminlogin.php';

    const savingpaymentreports = baseapiurl + 'reports/savingpaymentreports.php';
    const loanpaymentreports = baseapiurl + 'reports/loanpaymentreports.php';
    const customerreports = baseapiurl + 'reports/customerreports.php';
</script>