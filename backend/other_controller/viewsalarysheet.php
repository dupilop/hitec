<?php
require('../../db/connect.php');
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

<script type="text/javascript">
    $(document).ready(function() {

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
                    autoPrint: false
                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $('h1').text(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':not(.no-print)'
                    },
                    footer: true
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-o"></i>',
                    titleAttr: 'CSV',
                    title: $('h1').text()
                },
                {
                    extend: 'excel',
                    titleAttr: 'EXCEL',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: $('h1').text()
                },
                {
                    extend: 'colvis',
                    titleAttr: 'Column Visibility',
                    text: '<i class="fa fa-bars"></i>'
                },

            ],
            responsive: true

        });


    });
</script>
<?php
// $asd = $pdo->query("SELECT * FROM admins");
$query = "SELECT * FROM salarys";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
                <table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">
              
                  <thead class="thead-dark">
                    <tr>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Amount</th>
                      <th class="noExport">Action</th>
                    </tr>
                  </thead>
                  
              
                    <tbody>';
if ($total_row > 0) {
    foreach ($result as $a) {
        $d = explode("-", $a['sal_mon_year']);
        $output .= '
                        <tr>
                        <td>' . $a['sal_emp_name'] . '</td>
                        <td>' . $a['sal_designation'] . '</td>
                        <td>' . $d[1] . '</td>
                        <td>' . $d[0] . '</td>
                        <td>' . $a['sal_tincome'] . '</td>
                       
                        <td>
                       
                       
                        <button class="btn btn-sm btn-danger delete" id="' . $a['sal_id'] . '">
                        <i class="fa fa-trash"></i>
                        </button>
                       <a href="./other_controller/printsalary.php?sal_id=' . $a['sal_id'] . '"><button class="btn btn-sm btn-success">
                        <i class="fa fa-print"></i>
                        </button></a>
                       
  
                        </td>
                        </tr>';
    }
}


$output .= '</tbody>
                </table>';
echo $output;
?>