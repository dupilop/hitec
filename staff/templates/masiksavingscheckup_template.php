<?php

require('../db/connect.php');
$userid = $_SESSION['id'];
?>

         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
          <div class="card-body">
          
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
                  fixedHeader: true,
                  responsive: true,
             lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        orderCellsTop: true,
        fixedHeader: true,
         dom:
          "<'row'<'col-sm-4'><'col-sm-4 text-center'l><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-6'i><'col-sm-6'p>>"

        });
        table.column( 6 ).visible( false );
        table.column( 7 ).visible( false );
        table.column( 8 ).visible( false );
       var table_length2 = JSON.stringify(table.page.info().recordsDisplay);
    $("#couu").html('Total Records: '+table_length2);
    
    table.on('search.dt', function() {
      var table_length2 = JSON.stringify(table.page.info().recordsDisplay);
    $("#couu").html('Total Records: '+table_length2);
    
    });
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#month').val();
        var type = data[6];
 
        if (min == type || min == '')
        {
          
          return true;
        }
        return false;
    }
);        
    $("#monn").val(month.value);
              $('#month').change(function() {
                $("#monn").val(this.value);
                table.draw();

            } );
     $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#year').val();
        var type = data[7];
 
        if (min == type || min == '')
        {
            return true;
        }

        return false;
    }
);        
              $('#year').change(function() {
                $("#yrs").val(this.value);
                table.draw();
            } );
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#date').val();
        var type = data[8];
 
        if (min == type || min == '')
        {
            return true;
        }

        return false;
    }
);        
              $('#date').change(function() {
                $("#dat").val(this.value);
                table.draw();
            } );
              
          } );
    
     
   
            </script>
            

              <div class="table-responsive display">
                <?php

                $asd = $pdo->query("SELECT * FROM masiksavings ms
                  LEFT JOIN customers c ON c.c_id=ms.c_id GROUP BY ms.ms_dateupload ORDER BY ms_dateupload DESC 
                  ");

                ?>
               <table>
      <tr>
        <th style="padding: 20px;">Month</th>
        <td>
          <select class="form-control" id="month" style="padding: 10px;">
            <option value="">Select Month</option>
            <option>January</option>
          <option>February</option>
          <option>March</option>
          <option>April</option>
          <option>May</option>
          <option>June</option>
          <option>July</option>
          <option>August</option>
          <option>September</option>
          <option>October</option>
          <option>November</option>
          <option>December</option>
          </select>
        </td>

        <th style="padding: 20px;">Year</th>
        <td>
          <?php 
           date_default_timezone_set('Asia/Kathmandu');
          ?>
          <?php $years = range(2000, strftime("%Y", time())); ?>
          <select class="form-control" id="year" style="padding: 10px;">
            <option value="">Select Year</option>
            <?php foreach($years as $year) : ?>
              <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
          </select>
        </td>
        <th style="padding: 20px;">Date</th>
        <td>
          <select class="form-control" id="date" style="padding: 8px;">
            <option value="">Select Date</option>
            <?php 

            for($i=1;$i<33;$i++){
               if(strlen($i) == 1){
                $i = '0'.$i;
              }
              echo '<option>'.$i.'</option>';
            }

            ?>
            
          </select>
        </td>
      </tr>
    </table>
    <input type="hidden" id="monn" value="">
    <input type="hidden" id="yrs" value="">
    <input type="hidden" id="dat" value="">  
                <table class="table table-bordered display table-hover table-sm" width="100%" cellspacing="0" id="example"  style="width:100%">
                  <p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>
                  <thead class="thead-dark">
                    <tr>
                      <th class="sear">Account Number</th> 
                      <th class="sear">Customer Name</th>                     
                      <th class="sear">Saving Amount</th>
                      <th class="sear">Withdraw Amount</th>
                      <th class="sear">Old Savings</th>
                      <th class="sear">New Savings</th>
                      <th class="sear">Month</th>
                      <th class="sear">Year</th>
                      <th class="sear">Date</th>
                      <th class="fear" style="width:1%;"></th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="sear">Account Number</th> 
                      <th class="sear">Customer Name</th>                     
                      <th class="sear">Saving Amount</th>
                      <th class="sear">Withdraw Amount</th>
                      <th class="sear">Old Savings</th>
                      <th class="sear">New Savings</th>
                      <th class="sear">Month</th>
                      <th class="sear">Year</th>
                      <th class="sear">Date</th>
                      <th class="fear" style="width:1%;"></th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                 
                    foreach($asd as $a){
                       $s = $a['ms_dateupload'];
                        $dt = new DateTime($s);
                        $year = $dt->format('Y');
                        $month = $dt->format('m');
                        $date = $dt->format('d');
                        
                        
                    echo '<tr>';
                      echo '<td>'.$a['c_number'].'</td>';
                  
                      echo '<td>'.$a['c_name'].'</a></td>';
                      echo '<td>'.$a['ms_amount'].'</td>';
                      echo '<td>'.$a['ms_withdraw_amount'].'</td>';
                      echo '<td>'.$a['ms_previous_saving'].'</td>';
                      $totsaving = $a['ms_amount'] + $a['ms_previous_saving'] - $a['ms_withdraw_amount'];
                        echo '<td>' . $totsaving . '</td>';                 
                      
                      $dateObj   = DateTime::createFromFormat('!m', $month);
                      $monthName = $dateObj->format('F');
                      echo '<td>'.$monthName.'</td>';
                      echo '<td>'.$year.'</td>';
                        echo '<td>'.$date.'</td>';
                      echo '<td><a href="rollbackmasiksavings?ms_id='.$a['ms_id'].'" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Edit Saving"><i class="fa fa-times" aria-hidden="true"></i></td>';
                      echo '</tr>';
                      
                  }
                  ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
           




        
        


        