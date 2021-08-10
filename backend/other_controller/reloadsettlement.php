<?php
require('../../db/connect.php');
session_start();
?>

<script type="text/javascript">
    var total = 0;
</script>

<style type="text/css">
    .center {
        position: absolute;
        left: 70%;
        width: 100px;



    }
</style>


<?php

if ($_SESSION['access_level'] == 'superadmin') {
    $asd = $pdo->prepare("SELECT * FROM customers c
              INNER JOIN loans l ON c.c_id=l.l_c_id WHERE l.l_status='unpaid'
              ");
    $asd->execute();
} else if ($_SESSION['access_level'] == 'admin') {
    $asd = $pdo->prepare("SELECT * FROM loans l 
              INNER JOIN customers c ON c.c_id=l.l_c_id
              INNER JOIN admins a ON a.a_id=c.c_created_by 
              INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE (c.c_created_by=:cby || ra.ras_parent_id=:upby) && l.l_status='unpaid'
              ");
    $asd->execute(['cby' => $_SESSION['id'], 'upby' =>  $_SESSION['id']]);
} else if ($_SESSION['access_level'] == 'staff') {
    $asd = $pdo->prepare("SELECT * FROM loans l
              INNER JOIN customers c ON c.c_id=l.l_c_id
              INNER JOIN admins a ON a.a_id=c.c_created_by 
              INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby && l.l_status='unpaid'
              ");
    $asd->execute(['cby' => $_SESSION['id']]);
} else {
}
echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" name="example" width="100%" cellspacing="0">';


echo '<thead class="thead-dark">
                    <tr>
                      <th class="noExport">Customer Photo</th>
                      <th>Account Number</th>
                      <th>Customer Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Remaining Loan</th>
                     
                      <th class="noExport">Action</th>
                      
                    </tr>
                  </thead>
                  
              
                    <tbody>';


foreach ($asd as $a) {
    $cu1 = $pdo->prepare("SELECT SUM(l_remaining_loan) FROM loans WHERE l_c_id=:cid AND l_status=:lstatus");
    $cu1->execute(['cid' => $a['c_id'], 'lstatus' => 'unpaid']);
    $cu2 = $cu1->fetch();

    echo '<tr>';
    if ($a['c_photo'] != '') {
        echo '<td><a href="../images/customers/' . $a['c_photo'] . '"><img style="border-radius: 50%;" height="50px" width="50px" src="../images/customers/' . $a['c_photo'] . '"></a></td>';
    } else {
        echo '<td><img style="border-radius: 50%;" height="50px" width="50px" src="../images/noimage.jpg"></a></td>';
    }
    echo '<td>' . $a['c_number'] . '</td>';
    echo '<td id="name' . $a['c_id'] . '">' . $a['c_name'] . '</td>';

    echo '<td id="occu' . $a['c_id'] . '">' . $a['c_occupation'] . '</td>';
    echo '<td id="ema' . $a['c_id'] . '">' . $a['c_email'] . '</td>';
    echo '<td id="off' . $a['c_id'] . '">' . $a['l_remaining_loan'] . '</td>';
    $lcid = $a['c_id'];


    echo '<td><button type="button" class="btn btn-outline-warning btn-sm msettle" id="' . $a['l_id'] . '">Make a settlement</button>
    <button type="button" class="btn btn-outline-secondary btn-sm mprint" id="' . $a['l_id'] . '"><i class="fa fa-print" aria-hidden="true"></i>
    </button>
                      

                
                  </td>';

    echo '</tr>';
}


echo '</tbody>
                </table>';
?>
<script type="text/javascript">
    function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<script type="text/javascript">
    var table2 = $('#example').DataTable({

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        orderCellsTop: true,
        fixedHeader: true,
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
                title: $('h1').text(),
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':not(.no-print)'
                },
                footer: true,
                autoPrint: false,
                exportOptions: {
                    columns: "thead th:not(.noExport)"
                },
                customize: function(win) {
                    $(win.document.body)
                        .css('background', 'white')
                }
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
        responsive: true

    });
</script>