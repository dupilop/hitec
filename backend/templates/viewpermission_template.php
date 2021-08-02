<?php
require '../db/connect.php';
if ($_SESSION['access_level'] != 'superadmin') {
  header('Location: permissiondenied.php');
}
$a_id = $_GET['a_id'];
$abc = $pdo->prepare("SELECT * FROM permissions WHERE p_a_id=:a_id");
$abc->execute(['a_id' => $a_id]);
$abc2 = $abc->fetch();
$rabc2 = $abc->rowCount();
$chk1 = '';
$chk2 = '';
$chk3 = '';
$chk4 = '';
$chk5 = '';
$chk6 = '';
$chk7 = '';
$chk8 = '';
$chk9 = '';
$chk10 = '';
$chk11 = '';
$chk12 = '';
$chk13 = '';
$chk14 = '';
$chk15 = '';
$chk16 = '';
$chk17 = '';
$chk18 = '';
$chk19 = '';
$chk20 = '';
$chk21 = '';
$chk22 = '';
$chk23 = '';
$chk24 = '';
$chk25 = '';
$chk26 = '';
$chk27 = '';
$chk28 = '';
$chk29 = '';
$chk30 = '';
$chk31 = '';
$chk32 = '';

if ($abc2['p_add_customer'] == '1') {
  $chk1 = 'checked';
}
if ($abc2['p_edit_customer'] == '1') {
  $chk2 = 'checked';
}
if ($abc2['p_delete_customer'] == '1') {
  $chk3 = 'checked';
}
if ($abc2['p_add_stock'] == '1') {
  $chk4 = 'checked';
}
if ($abc2['p_edit_stock'] == '1') {
  $chk5 = 'checked';
}
if ($abc2['p_delete_stock'] == '1') {
  $chk6 = 'checked';
}
if ($abc2['p_make_save'] == '1') {
  $chk7 = 'checked';
}
if ($abc2['p_undosave'] == '1') {
  $chk8 = 'checked';
}
if ($abc2['p_emicalculator'] == '1') {
  $chk9 = 'checked';
}
if ($abc2['p_loanentry'] == '1') {
  $chk10 = 'checked';
}
if ($abc2['p_emipayment'] == '1') {
  $chk11 = 'checked';
}
if ($abc2['p_emisettlement'] == '1') {
  $chk12 = 'checked';
}
if ($abc2['p_undoemi'] == '1') {
  $chk13 = 'checked';
}
if ($abc2['p_savingreport'] == '1') {
  $chk14 = 'checked';
}
if ($abc2['p_emireport'] == '1') {
  $chk15 = 'checked';
}
if ($abc2['p_customerreport'] == '1') {
  $chk16 = 'checked';
}
if ($abc2['p_viewadminaccount'] == '1') {
  $chk17 = 'checked';
}
if ($abc2['p_addadminaccount'] == '1') {
  $chk18 = 'checked';
}
if ($abc2['p_editadminaccount'] == '1') {
  $chk19 = 'checked';
}
if ($abc2['p_deleteadminaccount'] == '1') {
  $chk20 = 'checked';
}
if ($abc2['p_viewstaffaccount'] == '1') {
  $chk21 = 'checked';
}
if ($abc2['p_addstaffaccount'] == '1') {
  $chk22 = 'checked';
}
if ($abc2['p_editstaffaccount'] == '1') {
  $chk23 = 'checked';
}
if ($abc2['p_deletestaffaccount'] == '1') {
  $chk24 = 'checked';
}
if ($abc2['p_viewnotification'] == '1') {
  $chk25 = 'checked';
}
if ($abc2['p_addnotification'] == '1') {
  $chk26 = 'checked';
}
if ($abc2['p_editnotification'] == '1') {
  $chk27 = 'checked';
}
if ($abc2['p_deletenotification'] == '1') {
  $chk28 = 'checked';
}
if ($abc2['p_viewsalary'] == '1') {
  $chk29 = 'checked';
}
if ($abc2['p_addsalary'] == '1') {
  $chk30 = 'checked';
}
if ($abc2['p_editsalary'] == '1') {
  $chk31 = 'checked';
}
if ($abc2['p_deletesalary'] == '1') {
  $chk32 = 'checked';
}
echo '<form  id="form1" method="POST">
                                       
                                        <span class="section">Manage Permission</span>';
echo '<div class="row">';
echo '<div class="col-12" style="display:flex;justify-content:flex-end;">';
echo '<table class="table table-bordered table-striped table-hover table-sm" id="example" width="100%" cellspacing="0">
              
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Title</th>
                                            <th class="noExport">Action</th>
                                          </tr>
                                        </thead>
                                        
                                    
                                          <tbody>
                                          <tr>
                                          <th>Add Customer</th>
                                          <td>';

echo '<input class="" name="p_add_customer" type="checkbox" ' . $chk1 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Customer</th>
                                          <td><input name="p_edit_customer" class="" type="checkbox"  ' . $chk2 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Customer</th>
                                          <td><input name="p_delete_customer" class="" type="checkbox"  ' . $chk3 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Add Stock</th>
                                          <td><input name="p_add_stock" name="" class="" type="checkbox"  ' . $chk4 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Stock</th>
                                          <td><input name="p_edit_stock" class="" type="checkbox"  ' . $chk5 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Stock</th>
                                          <td><input name="p_delete_stock" class="" type="checkbox"  ' . $chk6 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Make a save</th>
                                          <td><input name="p_make_save" class="" type="checkbox"  ' . $chk7 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Undo Save</th>
                                          <td><input name="p_undosave" class="" type="checkbox"  ' . $chk8 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Emi Calculator</th>
                                          <td><input name="p_emicalculator" class="" type="checkbox"  ' . $chk9 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Loan Entry</th>
                                          <td><input name="p_loanentry" class="" type="checkbox"  ' . $chk10 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Emi Payment</th>
                                          <td><input name="p_emipayment" class="" type="checkbox"  ' . $chk11 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Emi Settlement</th>
                                          <td><input name="p_emisettlement" class="" type="checkbox"  ' . $chk12 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Undo EMI</th>
                                          <td><input name="p_undoemi" class="" type="checkbox"  ' . $chk13 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Savings Report</th>
                                          <td><input name="p_savingreport" class="" type="checkbox"  ' . $chk14 . '></td>
                                          </tr>
                                          <tr>
                                          <th>EMI Report</th>
                                          <td><input name="p_emireport" class="" type="checkbox"  ' . $chk15 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Customer Report</th>
                                          <td><input name="p_customerreport" class="" type="checkbox"  ' . $chk16 . '></td>
                                          </tr>
                                          <tr>
                                          <th>View Admin Account</th>
                                          <td><input name="p_viewadminaccount" class="" type="checkbox"  ' . $chk17 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Add Admin Account</th>
                                          <td><input name="p_addadminaccount" class="" type="checkbox"  ' . $chk18 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Admin Account</th>
                                          <td><input name="p_editadminaccount" class="" type="checkbox"  ' . $chk19 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Admin Account</th>
                                          <td><input name="p_deleteadminaccount" class="" type="checkbox"  ' . $chk20 . '></td>
                                          </tr>
                                          <tr>
                                          <th>View Staff Account</th>
                                          <td><input name="p_viewstaffaccount" class="" type="checkbox"   ' . $chk21 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Add Staff Account</th>
                                          <td><input name="p_addstaffaccount" class="" type="checkbox"   ' . $chk22 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Staff Account</th>
                                          <td><input name="p_editstaffaccount" class="" type="checkbox"   ' . $chk23 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Staff Account</th>
                                          <td><input name="p_deletestaffaccount" class="" type="checkbox"   ' . $chk24 . '></td>
                                          </tr>
                                          <tr>
                                          <th>View Notification</th>
                                          <td><input name="p_viewnotification" class="" type="checkbox"   ' . $chk25 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Add Notification</th>
                                          <td><input name="p_addnotification" class="" type="checkbox"   ' . $chk26 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Notification</th>
                                          <td><input name="p_editnotification" class="" type="checkbox"   ' . $chk27 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Notification</th>
                                          <td><input name="p_deletenotification" class="" type="checkbox"   ' . $chk28 . '></td>
                                          </tr>
                                          <tr>
                                          <th>View Salary</th>
                                          <td><input name="p_viewsalary" class="" type="checkbox"   ' . $chk29 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Add Salary</th>
                                          <td><input name="p_addsalary" class="" type="checkbox"   ' . $chk30 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Edit Salary</th>
                                          <td><input name="p_editsalary" class="" type="checkbox"   ' . $chk31 . '></td>
                                          </tr>
                                          <tr>
                                          <th>Delete Salary</th>
                                          <td><input name="p_deletesalary" class="" type="checkbox"   ' . $chk32 . '></td>
                                          </tr>
                                          </tbody>
                                          </table>
                                          
                                        </div>
                                        <div class="col-md-12 col-sm-2">
                                        <input type="hidden" name="p_id" value="' . $abc2['p_id'] . '">
                                                <button class="btn btn-outline-success" type="submit" name="update" id="update" />Update</button>
                                            </div>
                                        </div>';



echo '                                      
                                    </form>
                                    ';

?>
<script type="text/javascript">
  function hideshow() {
    var password = document.getElementById("password1");
    var slash = document.getElementById("slash");
    var eye = document.getElementById("eye");

    if (password.type === 'password') {
      password.type = "text";
      slash.style.display = "block";
      eye.style.display = "none";
    } else {
      password.type = "password";
      slash.style.display = "none";
      eye.style.display = "block";
    }

  }
</script>