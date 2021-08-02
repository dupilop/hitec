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
  $asd = $pdo->prepare("SELECT * FROM customers
            ");
  $asd->execute();
} else if ($_SESSION['access_level'] == 'admin') {
  $asd = $pdo->prepare("SELECT * FROM customers c
            INNER JOIN admins a ON a.a_id=c.c_created_by 
            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby || ra.ras_parent_id=:upby
            ");
  $asd->execute(['cby' => $_SESSION['id'], 'upby' =>  $_SESSION['id']]);
} else if ($_SESSION['access_level'] == 'staff') {
  $asd = $pdo->prepare("SELECT * FROM customers c
            INNER JOIN admins a ON a.a_id=c.c_created_by 
            INNER JOIN roles_assign ra ON ra.ras_a_id=a.a_id WHERE c.c_created_by=:cby
            ");
  $asd->execute(['cby' => $_SESSION['id']]);
} else {
  echo 'error';
}
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
  echo '<td id="mob' . $a['c_id'] . '">' . $a['c_mobile'] . '</td>';
  echo '<td id="ema' . $a['c_id'] . '">' . $a['c_email'] . '</td>';
  echo '<td id="off' . $a['c_id'] . '">' . $a['c_office'] . '</td>';
  $lcid = $a['c_id'];


  echo '<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mod' . $a['c_id'] . '"><i class="fa fa-plus"></i></button>
                      
                      

                  <div class="modal fade bs-example-modal-sm" id="mod' . $a['c_id'] . '" data-backdrop="" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
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
                                             
                                                <input class="form-control title"  type="text" name="l_title" />
                                            </div>
                                            <div class="titleerror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Amount<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control amount" onkeypress="return onlyNumberKey(event)" pattern="^\d*(\.\d{0,2})?$" name="l_amount" type="text" />
                                            </div>
                                            <div class="amounterror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Down Payment<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control dpayment" onkeypress="return onlyNumberKey(event)" name="l_down_payment" type="text" />
                                            </div>
                                            <div class="dpaymenterror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Period (in mth)<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control lperiod" onkeypress="return onlyNumberKey(event)" name="l_period" type="text" maxlength="2"  />
                                            </div>
                                            <div class="lperioderror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Date</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control lupdatetime"  name="l_upload_date_time" type="datetime-local"  />
                                            </div>
                                            <div class="ldatetimeerror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Service Charge (in %)<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control servchargeper" onkeypress="return onlyNumberKey(event)"  type="text" maxlength="2"  />
                                            </div>
                                            <div class="schargepererror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Service Charge</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control-plaintext servchargeamt" name="l_service_charge" readonly onkeypress="return onlyNumberKey(event)"  type="text"  />
                                            </div>
                                            <div class="schargeamterror"></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Credit Limitations<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">';
                                            if($a['c_limitations']>$cu2[0]){
                                                  $clim = $a['c_limitations'] - $cu2[0];
                                            }else{
                                                $clim = 0;
                                            }
  echo '<input class="form-control-plaintext llimit" readonly onkeypress="return onlyNumberKey(event)" value="' . $clim . '" type="text" />';
  echo '</div>
                                            <div class="lperioderror"></div>
                                        </div>
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-3  label-align">Remaining Limitations<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control-plaintext rlimit" onkeypress="return onlyNumberKey(event)" value="0.00" type="text" />
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