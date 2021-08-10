
    var currentusertype = 'PROD';
    if (currentusertype === 'DEV') {
        var baseurl = 'http://localhost/hitecs/';
    } else {
        var baseurl = 'https://hitecnepal.com/';
    }
    var baseapiurl = baseurl + 'backend/api/';

    var customerregister = baseapiurl + 'customers/registration.php';

    //admin login
    var adminlogin = baseapiurl + 'authentication/adminlogin.php';

    var savingpaymentreports = baseapiurl + 'reports/savingpaymentreports.php';
    var loanpaymentreports = baseapiurl + 'reports/loanpaymentreports.php';
    var customerreports = baseapiurl + 'reports/customerreports.php';
    var customerdetails = baseapiurl + 'customers/customerdetails.php';
    var makeasave = baseapiurl + 'savings/makeasave.php';
    var emicalculator = baseapiurl+'calculator/emicalculator.php';
    var emioverviewcalculator = baseapiurl+'calculator/emioverviewcalculator.php';
    var loansettlementreport = baseapiurl+'reports/loansettlementreports.php';
    var loanreport = baseapiurl+'reports/loanreports.php';