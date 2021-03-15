 <?php
  session_start();
  require('../../db/connect.php');
  require '../../classes/databasetable.php';
  $sabc = new DatabaseTable('superadmins');
  $abc = new DatabaseTable('admins');
  $stabc = new DatabaseTable('staffs');
  $userid = $_SESSION['id'];
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
  $query = "SELECT * FROM notifications n
LEFT JOIN admins a ON n.u_id=a.a_id";
  $statement = $pdo->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '
                <table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">
              
                  <thead class="thead-dark">
                    <tr>
                      <th>Description</th>
                      <th>Sender Email</th>
                      <th>Sender Type</th>
                      <th>Receiver</th>
                      <th>Notification Date</th>
                      
                    
                      <th class="noExport">Action</th>
                    </tr>
                  </thead>
                  
              
                    <tbody>';
  if ($total_row > 0) {
    foreach ($result as $a) {
      if ($a['u_type'] == 'superadmin') {
        $q = $sabc->find('sa_id', $a['u_id']);
        $qq = $q->fetch();
        $email = $qq['sa_email'];
      } else if ($a['u_type'] == 'admins') {
        $email = $a['a_email'];
      } else {
        $q2 = $stabc->find('s_id', $a['u_id']);
        $qq2 = $q2->fetch();
        if (isset($qq['s_email'])) {
          $email = $qq['s_email'];
        } else {
          $email = '<span class="badge badge-warning">Not set</span>';
        }
      }
      $output .= '
                        <tr>
                        <td>' . $a['n_text'] . '</td>';



      $output .=
        '<td>' . $email . '</td>
                        <td>' . $a['u_type'] . '</td>
                        <td>' . $a['n_receiver'] . '</td>
                        <td>' . $a['n_date'] . '</td>
                       
                        <td>
                        <a href="editnotification?n_id=' . $a['n_id'] . '"><button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                        </button></a>
                       
                        <button class="btn btn-sm btn-danger delete" id="' . $a['n_id'] . '">
                        <i class="fa fa-trash"></i>
                        </button>
                       
                       
  
                        </td>
                        </tr>';
    }
  }


  $output .= '</tbody>
                </table>';
  echo $output;
  ?>