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
if ($_SESSION['access_level'] == 'superadmin') {
  $asd = $pdo->query("SELECT * FROM customers");
} else if ($_SESSION['access_level'] == 'admin') {
  $asd = $pdo->prepare("SELECT * FROM customers c 
INNER JOIN admins a ON a.a_id=c.c_created_by 
INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby || ra.ras_parent_id=:upby");
  $asd->execute(['cby' => $_SESSION['id'], 'upby' =>  $_SESSION['id']]);
} else if ($_SESSION['access_level'] == 'staff') {
  $asd = $pdo->prepare("SELECT * FROM customers c 
INNER JOIN admins a ON a.a_id=c.c_created_by 
INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby");
  $asd->execute(['cby' => $_SESSION['id']]);
} else {
  header('Location: permissiondenied.php');
}

echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" name="example" width="100%" cellspacing="0">';

?>
<thead class="thead-dark">
  <tr>
    <th class="noExport">Customer Photo</th>
    <th>Customer Name</th>
    <th>Account Number</th>
    <th>Date of Birth</th>
    <th>Occupation</th>
    <th>Mobile</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Permanent Address</th>
    <th>Current Address</th>
    <th>Street Address</th>
    <th>Email</th>
    <th>Office</th>
    <th>Father's Name</th>
    <th>Mother's Name</th>
    <th>Husband/Wife</th>
    <th>Grandfather</th>
    <th>Father-in-law</th>
    <th class="noExport">Action</th>

  </tr>
</thead>


<tbody>

  <?php
  foreach ($asd as $a) {
    echo '<tr>';
    if ($a['c_photo'] != '') {
      echo '<td><a href="../images/customers/' . $a['c_photo'] . '"><img style="border-radius: 50%;" height="50px" width="50px" src="../images/customers/' . $a['c_photo'] . '"></a></td>';
    } else {
      echo '<td><img style="border-radius: 50%;" height="50px" width="50px" src="../images/noimage.jpg"></a></td>';
    }
    echo '<td id="name' . $a['c_id'] . '">' . $a['c_name'] . '</td>';
    echo '<td id="name' . $a['c_id'] . '">' . $a['c_number'] . '</td>';
    echo '<td id="dob' . $a['c_id'] . '">' . $a['c_dob'] . '</td>';
    echo '<td id="occu' . $a['c_id'] . '">' . $a['c_occupation'] . '</td>';
    echo '<td id="mob' . $a['c_id'] . '">' . $a['c_mobile'] . '</td>';
    echo '<td id="pho' . $a['c_id'] . '">' . $a['c_phone'] . '</td>';
    echo '<td id="gen' . $a['c_id'] . '">' . $a['c_gender'] . '</td>';
    echo '<td id="pad' . $a['c_id'] . '">' . $a['c_permanent_address'] . '</td>';
    echo '<td id="cad' . $a['c_id'] . '">' . $a['c_current_address'] . '</td>';
    echo '<td id="str' . $a['c_id'] . '">' . $a['c_street_name'] . '</td>';
    echo '<td id="ema' . $a['c_id'] . '">' . $a['c_email'] . '</td>';
    echo '<td id="off' . $a['c_id'] . '">' . $a['c_office'] . '</td>';
    echo '<td id="fat' . $a['c_id'] . '">' . $a['c_father_name'] . '</td>';
    echo '<td id="mot' . $a['c_id'] . '">' . $a['c_mother_name'] . '</td>';
    echo '<td id="how' . $a['c_id'] . '">' . $a['c_husorwife_name'] . '</td>';
    echo '<td id="gfa' . $a['c_id'] . '">' . $a['c_gfather_name'] . '</td>';
    echo '<td id="fil' . $a['c_id'] . '">' . $a['c_fatherinlaw_name'] . '</td>';
    echo '<td>';
    if ($per->permit('p_edit_customer', $pdo)) {
      echo '<a href="editcustomer?id=' . $a['c_id'] . '"><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a>';
    }
    if ($per->permit('p_delete_customer', $pdo)) {
      echo '<button class="btn btn-sm btn-danger delete" id="' . $a['c_id'] . '"><i class="fa fa-trash"></i></button>';
    }
    echo '</td>';
    echo '</tr>';
  }
  ?>

</tbody>
</table>
<script type="text/javascript">
  $(".delete").on("click", function(e) {
    var id = $(this).attr('id');
    var data = 'id=' + id;
    e.preventDefault();
    pb.confirm(
      function(outcome) {
        if (outcome) {
          $.ajax({
            type: "GET",
            url: "other_controller/deletecustomer.php?did=" + id,
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
              pb.clear();
              pb.error('<i class="fa fa-trash fa-lg" aria-hidden="true"></i>   Deleted Successfully');
              load_data();
            }
          });
        }
      },
      '<h4 class="text text-danger">Are you sure you want to delete?</h4>',
      'Yes',
      'No'
    );
  });
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

    ]

  });
  table2.column(3).visible(false);
  table2.column(4).visible(false);
  table2.column(5).visible(false);
  table2.column(6).visible(false);
  table2.column(7).visible(false);
  table2.column(8).visible(false);
  table2.column(9).visible(false);
  table2.column(12).visible(false);
  table2.column(13).visible(false);
  table2.column(14).visible(false);
  table2.column(15).visible(false);
  table2.column(16).visible(false);
</script>