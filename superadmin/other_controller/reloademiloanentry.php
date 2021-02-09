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


<?php
$asd = $pdo->query("SELECT * FROM customers c 
                    LEFT JOIN loans l ON c.c_id=l.l_c_id 
                    ");
echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" name="example" width="100%" cellspacing="0">';


echo '<thead class="thead-dark">
                    <tr>
                      <th class="noExport">Customer Photo</th>
                      <th>Account Number</th>
                      <th>Customer Name</th>

                      <th>Occupation</th>
                      <th>Mobile</th>
                   
                      <th>Email</th>
                      <th>Office</th>
                     
                      <th class="noExport">Action</th>
                      
                    </tr>
                  </thead>
                  
              
                    <tbody>';


foreach ($asd as $a) {
  echo '<tr>';
  if ($a['c_photo'] != '') {
    echo '<td><a href="../images/customers/' . $a['c_photo'] . '"><img style="border-radius: 50%;" height="50px" width="50px" src="../images/customers/' . $a['c_photo'] . '"></a></td>';
  } else {
    echo '<td><img style="border-radius: 50%;" height="50px" width="50px" src="../images/noimage.jpg"></a></td>';
  }
  echo '<td>' . $a['c_number'] . '</td>';
  echo '<td id="name' . $a['c_id'] . '">' . $a['c_name'] . '</td>';

  echo '<td id="occu' . $a['c_id'] . '">' . $a['c_occupation'] . '</td>';
  echo '<td id="mob' . $a['c_id'] . '">' . $a['c_mobile'] . '</td>';
  echo '<td id="ema' . $a['c_id'] . '">' . $a['c_email'] . '</td>';
  echo '<td id="off' . $a['c_id'] . '">' . $a['c_office'] . '</td>';
  $lcid = $a['l_c_id'];

  $rr = $pdo->prepare("SELECT * FROM loans WHERE l_c_id ='$lcid' && l_status='unpaid'");
  $rr->execute();
  $result = $rr->fetchAll();
  $total_row = $rr->rowCount();
  if ($total_row > 0) {
    echo '<td><button type="button" class="btn btn-danger btn-sm btn-success"><i class="fa fa-refresh"></i></button></td>';
  } else {
    echo '<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mod' . $a['c_id'] . '"><i class="fa fa-plus"></i></button>
                      
                      

                  <div class="modal fade bs-example-modal-sm" id="mod' . $a['c_id'] . '" data-backdrop="" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                      <form class="" id="form1" action="" method="post" novalidate>
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Loan Entry</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Description<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                             
                                                <input class="form-control title"  type="text" name="l_title" required="required" />
                                            </div>
                                            <div class="titleerror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Amount<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control amount" name="l_amount" type="number" required="required" />
                                            </div>
                                            <div class="amounterror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Down Payment<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control dpayment" name="l_down_payment" type="number" required="required" />
                                            </div>
                                            <div class="dpaymenterror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Period (in mth)<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control lperiod" onkeypress="return onlyNumberKey(event)" name="l_period" type="text" maxlength="2" required="required" />
                                            </div>
                                            <div class="lperioderror"></div>
                                        </div>
                                       
                        <div class="modal-footer">
                        <input type="hidden" class="l_c_id" name="l_c_id" value="' . $a['c_id'] . '">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success submitloanentry" name="update">Apply</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  </td>';
  }
  echo '</tr>';
}


echo '</tbody>
                </table>';
?>
<script>
  // $(".lperiod").attr("maxlength", "14");

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