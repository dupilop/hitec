<?php
if (isset($_POST['update'])) {
    if ((isset($_POST['p_add_customer'])) && $_POST['p_add_customer'] == 'on') {
        $_POST['p_add_customer'] = 1;
    } else {
        $_POST['p_add_customer'] = 0;
    }
    if ((isset($_POST['p_edit_customer'])) && $_POST['p_edit_customer'] == 'on') {
        $_POST['p_edit_customer'] = 1;
    } else {
        $_POST['p_edit_customer'] = 0;
    }
    if ((isset($_POST['p_delete_customer'])) && $_POST['p_delete_customer'] == 'on') {
        $_POST['p_delete_customer'] = 1;
    } else {
        $_POST['p_delete_customer'] = 0;
    }
    if ((isset($_POST['p_add_stock'])) && $_POST['p_add_stock'] == 'on') {
        $_POST['p_add_stock'] = 1;
    } else {
        $_POST['p_add_stock'] = 0;
    }
    if ((isset($_POST['p_edit_stock'])) && $_POST['p_edit_stock'] == 'on') {
        $_POST['p_edit_stock'] = 1;
    } else {
        $_POST['p_edit_stock'] = 0;
    }
    if ((isset($_POST['p_delete_stock'])) && $_POST['p_delete_stock'] == 'on') {
        $_POST['p_delete_stock'] = 1;
    } else {
        $_POST['p_delete_stock'] = 0;
    }
    if ((isset($_POST['p_make_save'])) && $_POST['p_make_save'] == 'on') {
        $_POST['p_make_save'] = 1;
    } else {
        $_POST['p_make_save'] = 0;
    }
    if ((isset($_POST['p_undosave'])) && $_POST['p_undosave'] == 'on') {
        $_POST['p_undosave'] = 1;
    } else {
        $_POST['p_undosave'] = 0;
    }
    if ((isset($_POST['p_emicalculator'])) && $_POST['p_emicalculator'] == 'on') {
        $_POST['p_emicalculator'] = 1;
    } else {
        $_POST['p_emicalculator'] = 0;
    }
    if ((isset($_POST['p_loanentry'])) && $_POST['p_loanentry'] == 'on') {
        $_POST['p_loanentry'] = 1;
    } else {
        $_POST['p_loanentry'] = 0;
    }
    if ((isset($_POST['p_emipayment'])) && $_POST['p_emipayment'] == 'on') {
        $_POST['p_emipayment'] = 1;
    } else {
        $_POST['p_emipayment'] = 0;
    }
    if ((isset($_POST['p_emisettlement'])) && $_POST['p_emisettlement'] == 'on') {
        $_POST['p_emisettlement'] = 1;
    } else {
        $_POST['p_emisettlement'] = 0;
    }
    if ((isset($_POST['p_undoemi'])) && $_POST['p_undoemi'] == 'on') {
        $_POST['p_undoemi'] = 1;
    } else {
        $_POST['p_undoemi'] = 0;
    }
    if ((isset($_POST['p_savingreport'])) && $_POST['p_savingreport'] == 'on') {
        $_POST['p_savingreport'] = 1;
    } else {
        $_POST['p_savingreport'] = 0;
    }
    if ((isset($_POST['p_emireport'])) && $_POST['p_emireport'] == 'on') {
        $_POST['p_emireport'] = 1;
    } else {
        $_POST['p_emireport'] = 0;
    }
    if ((isset($_POST['p_customerreport'])) && $_POST['p_customerreport'] == 'on') {
        $_POST['p_customerreport'] = 1;
    } else {
        $_POST['p_customerreport'] = 0;
    }
    if ((isset($_POST['p_viewadminaccount'])) && $_POST['p_viewadminaccount'] == 'on') {
        $_POST['p_viewadminaccount'] = 1;
    } else {
        $_POST['p_viewadminaccount'] = 0;
    }
    if ((isset($_POST['p_addadminaccount'])) && $_POST['p_addadminaccount'] == 'on') {
        $_POST['p_addadminaccount'] = 1;
    } else {
        $_POST['p_addadminaccount'] = 0;
    }
    if ((isset($_POST['p_editadminaccount'])) && $_POST['p_editadminaccount'] == 'on') {
        $_POST['p_editadminaccount'] = 1;
    } else {
        $_POST['p_editadminaccount'] = 0;
    }
    if ((isset($_POST['p_deleteadminaccount'])) && $_POST['p_deleteadminaccount'] == 'on') {
        $_POST['p_deleteadminaccount'] = 1;
    } else {
        $_POST['p_deleteadminaccount'] = 0;
    }
    if ((isset($_POST['p_viewstaffaccount'])) && $_POST['p_viewstaffaccount'] == 'on') {
        $_POST['p_viewstaffaccount'] = 1;
    } else {
        $_POST['p_viewstaffaccount'] = 0;
    }
    if ((isset($_POST['p_addstaffaccount'])) && $_POST['p_addstaffaccount'] == 'on') {
        $_POST['p_addstaffaccount'] = 1;
    } else {
        $_POST['p_addstaffaccount'] = 0;
    }
    if ((isset($_POST['p_editstaffaccount'])) && $_POST['p_editstaffaccount'] == 'on') {
        $_POST['p_editstaffaccount'] = 1;
    } else {
        $_POST['p_editstaffaccount'] = 0;
    }
    if ((isset($_POST['p_deletestaffaccount'])) && $_POST['p_deletestaffaccount'] == 'on') {
        $_POST['p_deletestaffaccount'] = 1;
    } else {
        $_POST['p_deletestaffaccount'] = 0;
    }
    if ((isset($_POST['p_viewnotification'])) && $_POST['p_viewnotification'] == 'on') {
        $_POST['p_viewnotification'] = 1;
    } else {
        $_POST['p_viewnotification'] = 0;
    }
    if ((isset($_POST['p_addnotification'])) && $_POST['p_addnotification'] == 'on') {
        $_POST['p_addnotification'] = 1;
    } else {
        $_POST['p_addnotification'] = 0;
    }
    if ((isset($_POST['p_editnotification'])) && $_POST['p_editnotification'] == 'on') {
        $_POST['p_editnotification'] = 1;
    } else {
        $_POST['p_editnotification'] = 0;
    }
    if ((isset($_POST['p_deletenotification'])) && $_POST['p_deletenotification'] == 'on') {
        $_POST['p_deletenotification'] = 1;
    } else {
        $_POST['p_deletenotification'] = 0;
    }
    if ((isset($_POST['p_viewsalary'])) && $_POST['p_viewsalary'] == 'on') {
        $_POST['p_viewsalary'] = 1;
    } else {
        $_POST['p_viewsalary'] = 0;
    }
    if ((isset($_POST['p_addsalary'])) && $_POST['p_addsalary'] == 'on') {
        $_POST['p_addsalary'] = 1;
    } else {
        $_POST['p_addsalary'] = 0;
    }
    if ((isset($_POST['p_editsalary'])) && $_POST['p_editsalary'] == 'on') {
        $_POST['p_editsalary'] = 1;
    } else {
        $_POST['p_editsalary'] = 0;
    }
    if ((isset($_POST['p_deletesalary'])) && $_POST['p_deletesalary'] == 'on') {
        $_POST['p_deletesalary'] = 1;
    } else {
        $_POST['p_deletesalary'] = 0;
    }
    unset($_POST['update']);
    $abc = new DatabaseTable('permissions');
    $up1 = $abc->update($_POST, 'p_id');
    // print_r($_POST);
    header("Location: permission");
}
$title = 'View Permission';
$content = loadTemplate('templates/viewpermission_template.php', []);
