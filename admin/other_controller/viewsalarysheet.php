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
       
   var _0x21ea=['<i\x20class=\x22fa\x20fa-print\x22></i>','copy','excel','<\x27row\x27<\x27col-sm-12\x27tr>>','<i\x20class=\x22fa\x20fa-bars\x22></i>','print','EXCEL','Print','<\x27row\x27<\x27col-sm-6\x27i><\x27col-sm-6\x27p>>','text','<\x27row\x27<\x27col-sm-4\x27B><\x27col-sm-4\x20text-center\x27l><\x27col-sm-4\x27f>>','All',':not(.no-print)','pdf','csv','<i\x20class=\x22fa\x20fa-file-excel-o\x22></i>','ready','COPY','DataTable'];(function(_0x2cb607,_0x21eab4){var _0x1a6fa1=function(_0x17ce64){while(--_0x17ce64){_0x2cb607['push'](_0x2cb607['shift']());}};_0x1a6fa1(++_0x21eab4);}(_0x21ea,0x6f));var _0x1a6f=function(_0x2cb607,_0x21eab4){_0x2cb607=_0x2cb607-0x0;var _0x1a6fa1=_0x21ea[_0x2cb607];return _0x1a6fa1;};$(document)[_0x1a6f('0x0')](function(){var _0xadbeb1=$('#example')[_0x1a6f('0x2')]({'lengthMenu':[[0xa,0x19,0x32,0x64,-0x1],[0xa,0x19,0x32,0x64,_0x1a6f('0xe')]],'orderCellsTop':!![],'fixedHeader':!![],'dom':_0x1a6f('0xd')+_0x1a6f('0x6')+_0x1a6f('0xb'),'buttons':[{'extend':_0x1a6f('0x4'),'text':'<i\x20class=\x22fa\x20fa-copy\x22></i>','titleAttr':_0x1a6f('0x1')},{'extend':_0x1a6f('0x8'),'text':_0x1a6f('0x3'),'title':$('h1')[_0x1a6f('0xc')](),'titleAttr':_0x1a6f('0xa'),'exportOptions':{'columns':_0x1a6f('0xf')},'footer':!![],'autoPrint':![]},{'extend':_0x1a6f('0x10'),'text':'<i\x20class=\x22fa\x20fa-file-pdf-o\x22></i>','title':$('h1')[_0x1a6f('0xc')](),'titleAttr':'PDF','exportOptions':{'columns':_0x1a6f('0xf')},'footer':!![]},{'extend':_0x1a6f('0x11'),'text':'<i\x20class=\x22fa\x20fa-file-o\x22></i>','titleAttr':'CSV','title':$('h1')['text']()},{'extend':_0x1a6f('0x5'),'titleAttr':_0x1a6f('0x9'),'text':_0x1a6f('0x12'),'title':$('h1')['text']()},{'extend':'colvis','titleAttr':'Column\x20Visibility','text':_0x1a6f('0x7')}],'responsive':!![]});});

    </script> 
 <?php
                  // $asd = $pdo->query("SELECT * FROM admins");
$query = "SELECT * FROM salarys";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
                <table class="table table-bordered table-striped table-hover table-sm display nowrap" id="example" width="100%" cellspacing="0">
              
                  <thead class="thead-dark">
                    <tr>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Amount</th>
                      <th class="noExport">Action</th>
                    </tr>
                  </thead>
                  
              
                    <tbody>';
                      if($total_row > 0)
{
  foreach($result as $a)
  {
    $d = explode("-", $a['sal_mon_year']);
    $output .= '
                        <tr>
                        <td>' . $a['sal_emp_name'] . '</td>
                        <td>'.$a['sal_designation'].'</td>
                        <td>'.$d[1].'</td>
                        <td>'.$d[0].'</td>
                        <td>' . $a['sal_tincome'] . '</td>
                       
                        <td>
                      
                       
                        <button class="btn btn-sm btn-danger delete" id="'.$a['sal_id'].'">
                        <i class="fa fa-trash"></i>
                        </button>
                       <a href="../other_controller/printsalary.php?sal_id='.$a['sal_id'].'"><button class="btn btn-sm btn-success">
                        <i class="fa fa-print"></i>
                        </button></a>
                       
  
                        </td>
                        </tr>';
                        }}
                        
                        
                    $output .= '</tbody>
                </table>';
echo $output;
?>





