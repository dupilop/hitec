<?php
require '../db/connect.php';
require './../config.php';

if ($_SESSION['access_level'] != 'superadmin') {
  header('Location: permissiondenied.php');
}
$abc = $pdo->prepare("SELECT * FROM admins WHERE NOT a_id='1'");
$abc->execute();
$abc2 = $abc->fetchAll();
$rabc2 = $abc->rowCount();



echo '<form  id="form1" method="POST">
                                       
                                        <span class="section">Bed Time Management</span>';
echo '<div class="row">';
echo '<div class="col-12" style="display:flex;justify-content:flex-end;">';
echo '<table class="table table-bordered table-striped table-hover table-sm" id="example" width="100%" cellspacing="0">
              
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Title</th>
                                            <th class="noExport">Action</th>
                                          </tr>
                                        </thead>
                                        
                                    
                                          <tbody>';
                                          foreach ($abc2 as $abc3) {
                                              
                                              echo '<tr>
                                              <th>'.$abc3['a_fullname'].'</th>
                                              <td>';
                                              if($abc3['a_active'] == 1){
                                                  echo '<button class="btn btn-sm btn-outline-primary sleepme" id="'.$abc3['a_id'].'">Make to Sleep</button></td>';
                                              }else{
                                                echo '<button class="btn btn-sm btn-outline-success wakeme" id="'.$abc3['a_id'].'">Wake Up</button></td>';
                                              }
                                              echo '</tr>';
                                            }
                                        
                                         
                                         
                                          echo '</tbody>
                                          </table>
                                          
                                        </div>
                                       
                                        </div>';



echo '                                      
                                    </form>
                                    ';

?>
<script type="text/javascript">
 $(document).on("click", ".sleepme", function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    var data = {
        id: id,
        a_active: 0
    }
    $.ajax({
                type: "POST",
                url: accessmanagement,
                data: data,
                headers: {
                    "token": localStorage.getItem('token')
                },
                success: function(data) {
                    console.log(data)
                    pb.success(data.message);
                       
                       setTimeout(function() {
                        location.reload();
                       }, 2000);
                }
    })
 })
 $(document).on("click", ".wakeme", function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    var data = {
        id: id,
        a_active: 1
    }
    $.ajax({
                type: "POST",
                url: accessmanagement,
                data: data,
                headers: {
                    "token": localStorage.getItem('token')
                },
                success: function(data) {
                    console.log(data)
                    pb.clear();
                        pb.success(data.message);
                       
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                }
    })
 })
</script>