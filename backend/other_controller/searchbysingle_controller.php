<?php
require '../../db/connect.php';
session_start();
if ($_SESSION['access_level'] == 'superadmin') {

    if (isset($_POST['sdate']) && $_POST['sdate'] != '') {
        $asd = $pdo->prepare("SELECT * FROM masiksavings ms
        INNER JOIN customers c ON ms.c_id=c.c_id 
        INNER JOIN admins a ON a.a_id=ms.ms_uploadedby WHERE ms.ms_uploadedby=:aid && ms_dateupload LIKE :sdate
        ");
        $asd->execute(['aid' => $_POST['id'], 'sdate' => '%' . $_POST['sdate'] . '%']);
        $rc1 = $asd->rowCount();
        //show loans
        $asd2 = $pdo->prepare("SELECT * FROM loans l
INNER JOIN customers c ON l.l_c_id=c.c_id 
INNER JOIN admins a ON a.a_id=l.l_uploadedby WHERE l.l_uploadedby=:aid && l.l_status='unpaid' && l_upload_date_time LIKE :sdate
");
        $asd2->execute(['aid' => $_POST['id'], 'sdate' => $_POST['sdate'] . '%']);
        $rc2 = $asd2->rowCount();
        //show loan transaction
        $asd3 = $pdo->prepare("SELECT * FROM loan_transactions lt
INNER JOIN customers c ON lt.c_id=c.c_id 
INNER JOIN admins a ON a.a_id=lt.lt_uploadedby WHERE lt.lt_uploadedby=:aid && lt_uploaddate LIKE :sdate
");
        $asd3->execute(['aid' => $_POST['id'], 'sdate' => $_POST['sdate'] . '%']);
        $rc3 = $asd3->rowCount();

        //show loans settlement
        $asd4 = $pdo->prepare("SELECT * FROM loans l
INNER JOIN customers c ON l.l_c_id=c.c_id 
INNER JOIN admins a ON a.a_id=l.l_uploadedby WHERE l.l_settledby=:aid && l.l_status='paid' && l_upload_date_time LIKE :sdate
");
        $asd4->execute(['aid' => $_POST['id'], 'sdate' => $_POST['sdate'] . '%']);
        $rc4 = $asd4->rowCount();
        //show customers
        $asd5 = $pdo->prepare("SELECT * FROM customers WHERE c_created_by=:aid && c_created_on LIKE :sdate
");
        $asd5->execute(['aid' => $_POST['id'], 'sdate' => $_POST['sdate'] . '%']);
        $rc5 = $asd5->rowCount();
    } else {
        //show masik savings
        $asd = $pdo->prepare("SELECT * FROM masiksavings ms
                    INNER JOIN customers c ON ms.c_id=c.c_id 
                    INNER JOIN admins a ON a.a_id=ms.ms_uploadedby WHERE ms.ms_uploadedby=:aid
                    ");
        $asd->execute(['aid' => $_POST['id']]);
        $rc1 = $asd->rowCount();
        //show loans
        $asd2 = $pdo->prepare("SELECT * FROM loans l
    INNER JOIN customers c ON l.l_c_id=c.c_id 
    INNER JOIN admins a ON a.a_id=l.l_uploadedby WHERE l.l_uploadedby=:aid && l.l_status='unpaid'
    ");
        $asd2->execute(['aid' => $_POST['id']]);
        $rc2 = $asd2->rowCount();
        //show loan transaction
        $asd3 = $pdo->prepare("SELECT * FROM loan_transactions lt
    INNER JOIN customers c ON lt.c_id=c.c_id 
    INNER JOIN admins a ON a.a_id=lt.lt_uploadedby WHERE lt.lt_uploadedby=:aid
    ");
        $asd3->execute(['aid' => $_POST['id']]);
        $rc3 = $asd3->rowCount();
        //show loans settlement
        $asd4 = $pdo->prepare("SELECT * FROM loans l
    INNER JOIN customers c ON l.l_c_id=c.c_id 
    INNER JOIN admins a ON a.a_id=l.l_uploadedby WHERE l.l_settledby=:aid && l.l_status='paid'
    ");
        $asd4->execute(['aid' => $_POST['id']]);
        $rc4 = $asd4->rowCount();

        //show customers
        $asd5 = $pdo->prepare("SELECT * FROM customers WHERE c_created_by=:aid
    ");
        $asd5->execute(['aid' => $_POST['id']]);
        $rc5 = $asd5->rowCount();
    }
} else {
    header('Location: permissiondenied.php');
}
?>
<?php
if ($rc1 > 0) {
    echo '<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Saving Records</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">';

    echo '<table class="table table-bordered table-striped table-hover table-sm example" id="t1" width="100%" cellspacing="0">';
    echo '<p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>';


    echo '<thead class="thead-dark">
    <tr>
        <th>Customer Name</th>
        <th>Account Number</th>
        <th>Saving Amount</th>
        <th>Withdraw Amount</th>
        <th>Total</th>

    </tr>
</thead>
<tfoot>
    <tr class="bg-danger">
        <th>Total</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>


    </tr>
</tfoot>

<tbody>';
?>

<?php

    foreach ($asd as $a) {
        echo '<tr>';
        echo '<td>' . $a['c_name'] . '</td>';
        echo '<td>' . $a['c_number'] . '</td>';
        echo '<td>' . $a['ms_amount'] . '</td>';
        echo '<td>' . $a['ms_withdraw_amount'] . '</td>';
        $totsaving = $a['ms_amount'] - $a['ms_withdraw_amount'];
        echo '<td>' . $totsaving . '</td>';

        echo '</tr>';
    }


    echo '</tbody>
</table>
</div>
</div>
</div>
</div>';
}
?>
<?php
if ($rc2 > 0) {
    echo '<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Loan Records</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-striped table-hover table-sm example" id="t2" width="100%" cellspacing="0">
                    <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>

                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Account Number</th>
                            <th>Loan Amount</th>
                            <th>Down Payment</th>
                            <th>Service Charge</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-warning">
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </tfoot>

                    <tbody>';
?>

<?php

    foreach ($asd2 as $a2) {
        echo '<tr>';
        echo '<td>' . $a2['c_name'] . '</td>';
        echo '<td>' . $a2['c_number'] . '</td>';
        echo '<td>' . $a2['l_amount'] . '</td>';
        echo '<td>' . $a2['l_down_payment'] . '</td>';
        echo '<td>' . $a2['l_service_charge'] . '</td>';
        $totpay = $a2['l_amount'] - $a2['l_down_payment'] + $a2['l_service_charge'];
        echo '<td>' . $totpay . '</td>';

        echo '</tr>';
    }

    echo '</tbody>
</table>
</div>
</div>
</div>
</div>';
}
?>
<?php
if ($rc3 > 0) {
    echo '<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Loan transaction Records</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-striped table-hover table-sm example" id="t3" width="100%" cellspacing="0">
                    <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>

                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Account Number</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Penalty</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-secondary">
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </tfoot>

                    <tbody>';
?>
<?php

    foreach ($asd3 as $a3) {
        echo '<tr>';
        echo '<td>' . $a3['c_name'] . '</td>';
        echo '<td>' . $a3['c_number'] . '</td>';
        echo '<td>' . $a3['lt_principal'] . '</td>';
        echo '<td>' . $a3['lt_interest'] . '</td>';
        echo '<td>' . $a3['lt_penalty'] . '</td>';
        echo '<td>' . $a3['lt_grand_total'] . '</td>';

        echo '</tr>';
    }

    echo '</tbody>
</table>
</div>
</div>
</div>
</div>';
}
?>
<?php
if ($rc4 > 0) {

    echo '<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Settlement Records</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-striped table-hover table-sm example" id="t4" width="100%" cellspacing="0">
                    <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>

                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Account Number</th>
                            <th>Loan Amount</th>
                            <th>Down Payment</th>
                            <th>Service Charge</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-primary">
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </tfoot>

                    <tbody>';
?>

<?php

    foreach ($asd4 as $a4) {
        echo '<tr>';
        echo '<td>' . $a4['c_name'] . '</td>';
        echo '<td>' . $a4['c_number'] . '</td>';
        echo '<td>' . $a4['l_amount'] . '</td>';
        echo '<td>' . $a4['l_down_payment'] . '</td>';
        echo '<td>' . $a4['l_service_charge'] . '</td>';
        $totpay4 = $a4['l_amount'] - $a4['l_down_payment'] + $a4['l_service_charge'];
        echo '<td>' . $totpay4 . '</td>';

        echo '</tr>';
    }

    echo '</tbody>
</table>
</div>
</div>
</div>
</div>';
}
?>
<?php
if ($rc5 > 0) {
    echo '<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Customer Records</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-striped table-hover table-sm example" id="t5" width="100%" cellspacing="0">
                    <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>

                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Account Number</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Credit Limitations</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-success">
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </tfoot>

                    <tbody>';
?>
<?php

    foreach ($asd5 as $a5) {
        echo '<tr>';
        echo '<td>' . $a5['c_name'] . '</td>';
        echo '<td>' . $a5['c_number'] . '</td>';
        echo '<td>' . $a5['c_mobile'] . '</td>';
        echo '<td>' . $a5['c_email'] . '</td>';
        echo '<td>' . $a5['c_gender'] . '</td>';
        echo '<td>' . $a5['c_limitations'] . '</td>';

        echo '</tr>';
    }

    echo '</tbody>
</table>
</div>
</div>
</div>
</div>';
}
if ($rc1 == '' && $rc2 == '' && $rc3 == '' && $rc4 == '' && $rc5 == '') {
    echo '<div class="row mx-auto">
    <div class="col-md-12" style="display:flex;justify-content:center;">
    <h2 class="mx-auto px-2"> <i class="fas fa-ban"></i> No records found</h2>
    </div></div>';
}
?>
<script type="text/javascript">
    $(document).ready(function() {

        var table1 = $('#t1').DataTable({

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',

                    text: '<i class="fa fa-print"></i>',
                    title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

                    titleAttr: 'Print',
                    // footer: true,
                    // autoPrint: true,
                    exportOptions: {
                        columns: "thead th:not(.noExport)",
                    },

                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };



                total1 = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(2).footer()).html(
                    'Rs.' + total1
                );
                total2 = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(3).footer()).html(
                    'Rs.' + total2
                );
                total3 = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(4).footer()).html(
                    'Rs.' + total3
                );
            }

        });
        var table2 = $('#t2').DataTable({

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',

                    text: '<i class="fa fa-print"></i>',
                    title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

                    titleAttr: 'Print',
                    // footer: true,
                    // autoPrint: true,
                    exportOptions: {
                        columns: "thead th:not(.noExport)",
                    },

                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };



                total1 = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(2).footer()).html(
                    'Rs.' + total1
                );
                total2 = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(3).footer()).html(
                    'Rs.' + total2
                );
                total3 = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(4).footer()).html(
                    'Rs.' + total3
                );
                total4 = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    'Rs.' + total4
                );
            }

        });
        var table3 = $('#t3').DataTable({

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',

                    text: '<i class="fa fa-print"></i>',
                    title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

                    titleAttr: 'Print',
                    // footer: true,
                    // autoPrint: true,
                    exportOptions: {
                        columns: "thead th:not(.noExport)",
                    },

                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };



                total1 = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(2).footer()).html(
                    'Rs.' + total1
                );
                total2 = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(3).footer()).html(
                    'Rs.' + total2
                );
                total3 = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(4).footer()).html(
                    'Rs.' + total3
                );
                total4 = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    'Rs.' + total4
                );
            }

        });
        var table4 = $('#t4').DataTable({

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',

                    text: '<i class="fa fa-print"></i>',
                    title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

                    titleAttr: 'Print',
                    // footer: true,
                    // autoPrint: true,
                    exportOptions: {
                        columns: "thead th:not(.noExport)",
                    },

                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };



                total1 = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(2).footer()).html(
                    'Rs.' + total1
                );
                total2 = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(3).footer()).html(
                    'Rs.' + total2
                );
                total3 = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(4).footer()).html(
                    'Rs.' + total3
                );
                total4 = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    'Rs.' + total4
                );
            }

        });
        var table5 = $('#t5').DataTable({

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'COPY'
                }, {
                    extend: 'print',

                    text: '<i class="fa fa-print"></i>',
                    title: '<div style="text-align:center;"><img src="../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php echo date("Y-m-d");  ?></b><br /></div>',

                    titleAttr: 'Print',
                    // footer: true,
                    // autoPrint: true,
                    exportOptions: {
                        columns: "thead th:not(.noExport)",
                    },

                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text(),
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };



                total1 = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    'Rs.' + total1
                );


            }

        });
        // MergeGridCells();

        // function MergeGridCells() {
        //     var dimension_cells = new Array();
        //     var dimension_col = null;
        //     var columnCount = $(".example tr:first th").length;
        //     for (dimension_col = 0; dimension_col < columnCount; dimension_col++) {
        //         // first_instance holds the first instance of identical td
        //         var first_instance = null;
        //         var rowspan = 1;
        //         // iterate through rows
        //         $(".example").find('tr').each(function() {

        //             // find the td of the correct column (determined by the dimension_col set above)
        //             var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');

        //             if (first_instance == null) {
        //                 // must be the first row
        //                 first_instance = dimension_td;
        //             } else if (dimension_td.text() == first_instance.text()) {
        //                 // the current td is identical to the previous
        //                 // remove the current td
        //                 dimension_td.remove();
        //                 ++rowspan;
        //                 // increment the rowspan attribute of the first instance
        //                 first_instance.attr('rowspan', rowspan);
        //             } else {
        //                 // this cell is different from the last
        //                 first_instance = dimension_td;
        //                 rowspan = 1;
        //             }
        //         });
        //     }
        // }







    });
</script>