<?php
require('../db/connect.php');
?>

         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-body">
          
          
            

              <div class="table-responsive display">
                <?php

                $asd = $pdo->query("SELECT * FROM customers c
                  RIGHT JOIN loans l ON c.c_id=l.l_c_id
                  ");

                ?>
                <table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example"  style="width:100%">

                  <thead class="thead-dark">
                    <tr>
                      <th class="sear">Account Number</th> 
                      <th class="sear">Customer Name</th>                     
                      <th class="sear">Customer Occupation</th>
                      <th class="sear">Remaining loan</th>
                      <th class="fear" style="width:1%;"></th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="sear">Account Number</th>
                      <th class="sear">Customer Name</th>
                      <th class="sear">Customer Address</th>
                      <th class="sear">Remaining loan</th>
                      <th class="fear" style="width:1%;"></th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                 
                    foreach($asd as $a){
                       
                        
                        
                    echo '<tr>';
                      echo '<td>'.$a['c_number'].'</td>';
                  
                      echo '<td>'.$a['c_name'].'</a></td>';
                      echo '<td>'.$a['c_occupation'].'</td>';
                      echo '<td>'.$a['l_remaining_loan'].'</td>';
                      $advance_amount = $a['l_remaining_loan'];
                      echo '<td><a href="loanpayment?c_id='.$a['c_id'].'" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Add payment"><i class="fa fa-plus"></i></td>';
                      echo '</tr>';
                      
                  }
                  ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
         
          
          <div class="container-fluid">

          <?php

          if(isset($_GET['c_id'])){
            $shid = $_GET['c_id'];
            $dat2 = $pdo->query("SELECT * FROM customers c 
              LEFT JOIN loans l ON c.c_id=l.l_c_id
              WHERE c.c_id ='$shid'")->fetch();
            
             
            ?>
         
            <div class = "row">
              <div class="col-xl-4 col-md-2 mb-4">
              <div class="card shadow h-30 py-2" style="background:#2a3f54;color:white;">
                <div class="card-body" style="color:white;">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <b>Account No:<br>
                      Name:<br>
                      Occupation: <br>
                      Contact No: <br> </b>
                    </div>
                    <div class="col-auto">
                      <?php echo $dat2['c_number']; ?><br>
                      <?php echo $dat2['c_name']; ?><br>
                      <?php echo $dat2['c_occupation']; ?><br>
                      <?php echo $dat2['c_mobile']; ?><br>
                    </div>
                  </div>
                </div>
            
            </div>
          </div>
       


          <div class="col-xl-8 col-md-2 mb-4">
              <div class="card shadow h-100 py-2" style="background:white;">
                <div class="card-body" style="color:black;">
                  <div class="row no-gutters align-items-center">
                    <form action="loanpayment" method="POST">
                    <div class="col mr-2 form-group row">
                      <label for="total_amount" class="col-lg-7 col-form-label"><b>Total loan (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" id = "total_amount"
                        value="<?php echo $dat2['l_amount']; ?>" style="width: 100%;">
                    </div>
                  </div>
                  <div class="col mr-2 form-group row">
                      <label for="total_amount" class="col-lg-7 col-form-label"><b>Remaining Payments (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" id = "total_remaining_amount" 
                        value="<?php echo $dat2['l_remaining_loan']; ?>" style="width: 100%;">
                        <input type="text" readonly class="form-control-plaintext" id = "total_new_remaining_amount" name = "total_new_remaining_amount" 
                        value="<?php echo $dat2['l_remaining_loan']; ?>" style="width: 100%;color:red;">
                    </div>
                  </div>
                    <div class="col mr-2 form-group row">
                      <label for="total_amount" class="col-lg-7 col-form-label"><b>Principal (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="number" class="form-control" id = "principal" name="lt_principal" value="0" style="width: 100%;">
                    </div>
                  </div>
                 

                  <div class="col mr-2 form-group row">
                      <label for="tender" class="col-lg-7 col-form-label"><b>Special Offer (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="number" name="lt_discount" class="form-control" id="discount_amount" value="0" style="width: 100%;" required>
                    </div>
                  </div>
                  <div class="col mr-2 form-group row">
                      <label for="tender" class="col-lg-7 col-form-label"><b>Interest (in Rs): </b></label>
                      <div class="col-sm-5">
                        <input type="number" name="lt_interest" class="form-control" id="interest_amount" value="0" style="width: 100%;" required>
                    </div>
                  </div>
                  <div class="col mr-2 form-group row">
                      <label for="tender" class="col-lg-7 col-form-label"><b>Penalty (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="number" name="lt_penalty" id="penalty_amount" class="form-control" value="0" style="width: 100%;" required>
                    </div>
                  </div>
                  <div class="col mr-2 form-group row">
                      <label for="tender" class="col-lg-7 col-form-label"><b>Grand Total (in Rs):</b></label>
                      <div class="col-sm-5">
                        <input type="number" readonly name="lt_grand_total"  id="grand_total" class="form-control-plaintext" value="0" style="width: 100%;" required>
                    </div>
                  </div>
                  <div class="row no-gutters align-items-center" style="margin-left: 300px;">
                    <input type="hidden" name="lt_l_id" value="<?php echo $dat2['l_id']; ?>"  class="form-control">
                    <input type="hidden" name="c_id" value="<?php echo $dat2['c_id']; ?>"  class="form-control">
                    <input type="submit" value="Pay" id="pay" name="pay"  class="form-control btn-success">
                    
                  </div>
                 
                  </form>
                </div>
            
           
            
            </div>
            </div>
            </div>
           </div>
           <div class = "row">
           <div class="col-xl-12 col-md-2 mb-4">
           <div class="card shadow h-100 py-2" style="background:white;">
                <div class="card-body" style="color:black;">
                  <div class="row no-gutters align-items-center">
             <div class="table-responsive">
               <?php 
                $asd = $pdo->query("SELECT * FROM loan_transactions lt
                LEFT JOIN customers c ON lt.c_id=c.c_id 
                INNER JOIN loans l ON lt.lt_l_id=l.l_id WHERE l.l_c_id='$shid'
                ");
                $asd2 = $pdo->query("SELECT * FROM loans WHERE l_c_id='$shid'
                ");
                $asdd2 = $asd2->fetch();
                $rcasd2 = $asd2->rowCount();
              ?>
               <table class="table table-bordered table-striped table-hover table-sm example2" id="example2" width="100%" cellspacing="0">
                 <thead class="thead-dark">
                   <tr>
                     <th>#</th>
                     <th>Date</th>
                     <th>Principal</th>
                     <th>Discount</th>
                     <th>Interest</th>
                     <th>Penalty</th>
                     <th>Grand Total</th>
                   </tr>
                  
                 </thead>
                 <tfoot>
                    <tr style="color:white;background: red;">
                      <th colspan="2">Total</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    
                  </tfoot>
                  <?php 
                      if($rcasd2 >0){
                        $vall =  intval($asdd2['l_down_payment']);
                      }else{
                        $vall = intval(0);
                      }
                     ?>
                 <tbody>
                 <tr style="background:blanchedalmond;">
                    <td></td>
                    <td><b style="color:red;">Down Payment</b></td>
                    <b style="color:red;"><td><?php echo $vall; ?></td></b>
                    <td></td>
                    <td></td>
                    <td></td>
                    <b style="color:red;"><td><?php echo $vall; ?></td></b>
                    
                   </tr>
                 <?php
                 $vv=1;
                      foreach ($asd as $a) {
                        $s = $a['lt_uploaddate'];
                       
                        echo '<tr>';
                        echo '<td>'.$vv.'</td>';
                        echo '<td>'.$s.'</td>';
                        echo '<td>' . $a['lt_principal'] . '</td>';
                        echo '<td>' . $a['lt_discount'] . '</td>';
                        echo '<td>' . $a['lt_interest'] . '</td>';
                        echo '<td>' . $a['lt_penalty'] . '</td>';
                        echo '<td>' . $a['lt_grand_total'] . '</td>';
                        echo '</tr>';
                        $vv++;
                        }
                        ?>
                 </tbody>
                 
               </table>
             </div>
           </div>
           </div>
           </div>
           </div>
           </div>
            
            <?php } 
            ?>
       
         </div>    
         <script type="text/javascript">
              $(document).ready(function() {
                
              // Setup - add a text input to each footer cell
              $('#example thead tr').clone(true).appendTo( '#example thead' );
              $('#example thead tr:eq(1) th.sear').each( function (i) {
                  var title = $(this).text();
                  $(this).html( '<input type="text" class="form-control"/>' );
              
                  $( 'input', this ).on( 'keyup change', function () {
                      if ( table.column(i).search() !== this.value ) {
                          table
                              .column(i)
                              .search( this.value )
                              .draw();
                      }
                  } );
                 
              } );
              var table = $('#example').DataTable( {
                  orderCellsTop: true,
                  fixedHeader: true
              } );
              var table2 = $("#example2").DataTable( {
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        orderCellsTop: true,
        fixedHeader: true,
         dom:
          "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-6'i><'col-sm-6'p>>",     

        buttons: [
            {
       extend: 'copy',
       text: '<i class="fa fa-copy"></i>',
       titleAttr: 'COPY',
       exportOptions: {
                        columns: "thead th:not(.noExport)"
      }
    },{
      extend: 'print',
      
      text: '<i class="fa fa-print"></i>',
      title: '<div style="text-align:center;"><img src="../../images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php  echo date("Y-m-d");  ?></b><br /></div>',

      titleAttr: 'Print',
      footer: true,
      autoPrint: true,
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
      extend : 'excel',
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

    
        ],responsive: true,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
          
 
            total1 = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 2 ).footer() ).html(
                'Rs.'+total1 
            );
            total2 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 3 ).footer() ).html(
                'Rs.'+total2
            );
            total3 = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 4 ).footer() ).html(
                'Rs.'+total3 
            );

            total4 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 5 ).footer() ).html(
                'Rs.'+total4 
            );

            total5 = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 6 ).footer() ).html(
                'Rs.'+total5 
            );
            

           
           
        }

              }); 
             
              
               
          } );
    
          
   
            </script>
<script type="text/javascript">
  var principal = $("#principal").val();
  var discount_amount = $("#discount_amount").val();
  var interest_amount = $("#interest_amount").val();
  var penalty_amount = $("#penalty_amount").val();
  var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
  $("#grand_total").val(gtotal);

  $("#principal").on("change keyup", function(){
    var principal = $("#principal").val();
  var discount_amount = $("#discount_amount").val();
  var interest_amount = $("#interest_amount").val();
  var penalty_amount = $("#penalty_amount").val();
  var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
  $("#grand_total").val(gtotal);
  var rempayment = $("#total_remaining_amount").val();
  var diff = Number(rempayment) - Number(principal);
  $("#total_new_remaining_amount").val(diff);

  });

  $("#discount_amount").on("change keyup", function(){
    var principal = $("#principal").val();
  var discount_amount = $("#discount_amount").val();
  var interest_amount = $("#interest_amount").val();
  var penalty_amount = $("#penalty_amount").val();
  var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
  $("#grand_total").val(gtotal);

  });

  $("#interest_amount").on("change keyup", function(){
    var principal = $("#principal").val();
  var discount_amount = $("#discount_amount").val();
  var interest_amount = $("#interest_amount").val();
  var penalty_amount = $("#penalty_amount").val();
  var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
  $("#grand_total").val(gtotal);

  });

  $("#penalty_amount").on("change keyup", function(){
    var principal = $("#principal").val();
  var discount_amount = $("#discount_amount").val();
  var interest_amount = $("#interest_amount").val();
  var penalty_amount = $("#penalty_amount").val();
  var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
  $("#grand_total").val(gtotal);

  });
 </script>
 