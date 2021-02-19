<?php

require('../db/connect.php');
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
       
   
        $(document).ready(function(){
        
       var table2 = $('#example').DataTable( {
        
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
      title: '<div style="text-align:center;"><img src="http://localhost/EMI/images/logo/a.png" height="100px" width="100px" alt="image" style="position:absolute;left:45%;"><br /><br /></div><div style="text-align:center;" id="head"><h1>HITEC VISION PVT. LTD</h2></div><div style="text-align:center;font-size:15px;color:black;" id="pdate"><b>Printed Date: <?php  echo date("Y-m-d");  ?></b><br /></div>',

      titleAttr: 'Print',
      footer: true,
      autoPrint: true,
      exportOptions: {
                        columns: "thead th:not(.noExport)",
      },
      
       customize: function ( win ) {
                    $(win.document.body)
                        .css( 'background', 'white' )
                        .css( 'font-size', 'inherit' )
                        
                    var mon = $("#monn").val(); 
                    var yrs = $("#yrs").val();
                    var date = $("#dat").val();
                    var comdate = '';
                    if(mon=='' && yrs =='' && date==''){
                      comdate = 'All time';
                    }
                    if(yrs != ''){
                       
                       yrs = '-'+yrs;
                    }
                    if(date != ''){
                       
                       date = '-'+date;
                    }
                    if(mon == ''){
                      yrs = $("#yrs").val();
                    }
                    if(mon == '' && yrs ==''){
                      date = $("#dat").val();
                    }
                    $(win.document.body).find( '#pdate' ).prepend('<div style="text-align:center;font-size:15px;color:black;"><b>PAYMENT DONE ON : '+mon +yrs+date+comdate+'</b></div>');
                   
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
    
        ]

        });
           var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
    $("#couu").html('Total Records: '+table_length2);
    
    table2.on('search.dt', function() {
      var table_length2 = JSON.stringify(table2.page.info().recordsDisplay);
    $("#couu").html('Total Records: '+table_length2);
    
    });
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#month').val();
        var type = data[7];
 
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
                table2.draw();

            } );
     $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#year').val();
        var type = data[8];
 
        if (min == type || min == '')
        {
            return true;
        }

        return false;
    }
);        
              $('#year').change(function() {
                $("#yrs").val(this.value);
                table2.draw();
            } );
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  $('#date').val();
        var type = data[9];
 
        if (min == type || min == '')
        {
            return true;
        }

        return false;
    }
);        
              $('#date').change(function() {
                $("#dat").val(this.value);
                table2.draw();
            } );
       table2.column( 5 ).visible( false );
        table2.column( 7 ).visible( false );
         table2.column( 8 ).visible( false );


     
     });
 

    </script> 
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
                <?php
                  $asd = $pdo->query("SELECT * FROM loan_transactions lt
                    INNER JOIN customers c ON lt.c_id=c.c_id 
                    LEFT JOIN loans l ON lt.lt_l_id=l.l_id
                    ");
                echo '<table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">';
              echo '<p style="text-align:center; caption-side:top; color:#013220; font-family:verdana;font-size:20px;"> <b style="font-size:24px; color:red;" id="couu"></b></p>';
                ?>
                  <thead class="thead-dark">
                    <tr>
                      <th>Customer Name</th>
                      <th>Account Number</th>
                      <th>Principal</th>
                      <th>Discount</th>
                      <th>Interest</th>
                      <th>Penalty</th>
                      <th>Grand Total</th>                   
                      <th class="noExport">Month</th>
                      <th class="noExport">Year</th>
                      <th class="noExport">Date</th>
                      <th  class="noExport">Status</th>
                       <th class="noExport">Action</th>
               
                    </tr>
                  </thead>
                  
              
                    <tbody>
                        
                      <?php
                      foreach ($asd as $a) {
                        $s = $a['lt_uploaddate'];
                        $dt = new DateTime($s);
                        $year = $dt->format('Y');
                        $month = $dt->format('m');
                        $date = $dt->format('d');
                        echo '<tr>';
                        echo '<td>' . $a['c_name'] . '</td>';
                        echo '<td>' . $a['c_number'] . '</td>';
                        echo '<td>' . $a['lt_principal'] . '</td>';
                        echo '<td>' . $a['lt_discount'] . '</td>';
                        echo '<td>' . $a['lt_interest'] . '</td>';
                        echo '<td>' . $a['lt_penalty'] . '</td>';
                        echo '<td>' . $a['lt_grand_total'] . '</td>';
                        $dateObj   = DateTime::createFromFormat('!m', $month);
                        $monthName = $dateObj->format('F');
                        echo '<td>'.$monthName.'</td>';
                        echo '<td>'.$year.'</td>';
                        echo '<td>'.$date.'</td>';
                        if($a['l_status'] == 'unpaid'){
                          echo '<td><span class="badge badge-danger">Running</span></td>';
                        }else{
                          echo '<td><span class="badge badge-success">Completed</span></td>';
                        }
                        echo '<td><a href="cancelemibill?cbid='.$a['lt_id'].'" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a></td>';
                        echo '</tr>';
                        }
                        ?>
                        
                    </tbody>
                </table>
             