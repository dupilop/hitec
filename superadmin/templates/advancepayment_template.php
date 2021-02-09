<?php
require('../db/connect.php');
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
    table2.column(2).visible(false);
    table2.column(4).visible(false);
    table2.column(5).visible(false);
    table2.column(6).visible(false);
    table2.column(7).visible(false);
    table2.column(8).visible(false);
    table2.column(10).visible(false);
    table2.column(12).visible(false);
    table2.column(13).visible(false);
    table2.column(14).visible(false);
    table2.column(15).visible(false);
    table2.column(16).visible(false);
    table2.column(17).visible(false);

  });
</script>
<?php
$asd = $pdo->query("SELECT * FROM customers c 
                    LEFT JOIN advances a ON c.c_id=a.adv_c_id");
echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" name="example" width="100%" cellspacing="0">';

?>
<thead class="thead-dark">
  <tr>
    <th class="noExport">Customer Photo</th>
    <th>Account Number</th>
    <th>Customer Name</th>
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
    echo '<td>' . $a['c_number'] . '</td>';
    echo '<td id="name' . $a['c_id'] . '">' . $a['c_name'] . '</td>';
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
    echo '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-plus"></i></button>

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                      <form class="" action="" method="post" novalidate>
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           
                                       
                                        <span class="section">Personal Details</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                             
                                                <input class="form-control-plaintext" readonly data-validate-length-range="6" data-validate-words="2"  value="' . $a['c_email'] . '" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Advance Amount<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="advance_amount" value="' . $a['advance_amount'] . '" required="required" />
                                            </div>
                                        </div>
                                       
                        <div class="modal-footer">
                        <input type="hidden" name="adv_id" value="' . $a['adv_id'] . '">
                        <input type="hidden" name="adv_c_id" value="' . $a['c_id'] . '">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  </td>';

    echo '</tr>';
  }
  ?>

</tbody>
</table>