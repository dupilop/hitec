 <?php
  require '../../db/connect.php';
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


 <?php
  // $asd = $pdo->query("SELECT * FROM admins");
  if ($_SESSION['access_level'] == 'superadmin') {
    $query = "SELECT * FROM admins a
  INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
  INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:r_name";
    $statement = $pdo->prepare($query);
    $statement->execute(['r_name' => 'staff']);
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
  } else if ($_SESSION['access_level'] == 'admin') {
    $query = "SELECT * FROM admins a
    INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id
    INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r.r_name=:r_name && ra.ras_parent_id=:pid";
    $statement = $pdo->prepare($query);
    $statement->execute(['r_name' => 'staff', 'pid' => $_SESSION['id']]);
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
  } else {
  }
  $output = '
                <table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">
              
                  <thead class="thead-dark">
                    <tr>
                      <th>Account Name</th>
                      <th>Date of Birth</th>
                      <th>Position</th>
                      <th>Mobile</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Assigned To</th>
                      <th class="noExport">Action</th>
                    </tr>
                  </thead>
                  
              
                    <tbody>';
  if ($total_row > 0) {
    foreach ($result as $a) {
      $output .= '
                        <tr>
                        <td>' . $a['a_fullname'] . '</td>
                        <td>' . $a['a_dob'] . '</td>
                        <td>' . $a['a_position'] . '</td>
                        <td>' . $a['a_mobile'] . '</td>
                        <td>' . $a['a_gender'] . '</td>
                        <td>' . $a['a_email'] . '</td>';
      $f1 = $pdo->prepare("SELECT * FROM admins WHERE a_id=:aid");
      $f1->execute(['aid' => $a['ras_parent_id']]);
      $f2 = $f1->fetch();
      $rf2 = $f1->rowCount();
      if ($rf2 > 0) {
        $assto = $f2['a_fullname'];
      } else {
        $assto = 'Not assigned';
      }
      $output .= '<td>' . $assto . '</td>';
      $output .= '<td>';
      if ($per->permit('p_editstaffaccount', $pdo)) {
        $output .= '<a href="editstaffaccount?a_id=' . $a['a_id'] . '"><button type="button" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-edit"></i>
                        </button></a>';
      }
      if ($per->permit('p_deletestaffaccount', $pdo)) {
        $output .= '<button class="btn btn-sm btn-outline-danger delete" id="' . $a['a_id'] . '">
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
 </script>