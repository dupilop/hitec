 <?php
    require('../../db/connect.php');
    session_start();
    require '../other_controller/permission_controller.php';
    $per = new permission();
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
    $query = "SELECT * FROM stocks ORDER BY st_uploadedon DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '
                <table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">
              
                  <thead class="thead-dark">
                    <tr>
                      <th>Image</th>
                      <th>Description</th>
                      <th>Model no</th>
                      <th>Price</th>
                      <th>Date of Purchase</th>
                      
                    
                      <th class="noExport">Action</th>
                    </tr>
                  </thead>
                  
              
                    <tbody>';
    if ($total_row > 0) {
        foreach ($result as $a) {
            $output .= '
                        <tr>
                        <td>';
            $output .= '<img src="' . $baseapiurl . 'images/stocks/' . $a['st_image'] . '" height="60rem" width="60rem" onerror="this.src=`http://aimantfzc.com/wp-content/uploads/2017/12/product-no-image.jpg`;" /></td>';

            $output .= '<td>' . $a['st_desc'] . '</td>
                        <td>' . $a['st_model_no'] . '</td>
                        <td>' . $a['st_price'] . '</td>
                        <td>' . $a['st_date'] . '</td>           
                        <td>';
            if ($per->permit('p_edit_stock', $pdo)) {
                $output .= '<a href="editstock?st_id=' . $a['st_id'] . '"><button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                        </button></a>';
            }
            if ($per->permit('p_delete_stock', $pdo)) {
                $output .= '<button class="btn btn-sm btn-danger delete" id="' . $a['st_id'] . '">
                        <i class="fa fa-trash"></i>
                        </button>';
            }
            $output .= '</td>
                        </tr>';
        }
    }


    $output .= '</tbody>
                </table>';
    echo $output;
    ?>