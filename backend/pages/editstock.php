<?php
$abc = new DatabaseTable('stocks');
if (isset($_POST['update'])) {
    unset($_POST['update']);
    if (isset($_FILES)) {
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt');
        $img1 = $_FILES['st_image']['name'];

        $ext1 = strtolower(pathinfo($img1, PATHINFO_EXTENSION));

        $final_image1 = rand(1000, 1000000) . $img1;

        if (in_array($ext1, $valid_extensions)) {
            $path1 = strtolower($final_image1);
        }

        if ($_FILES['st_image']['error'] == 0) {
            $_POST['st_image'] = $path1;
            move_uploaded_file($_FILES['st_image']['tmp_name'], './api/images/stocks/' . $path1);
        }
    }
    $ins = $abc->update($_POST, 'st_id');
    // print_r($_POST);
    header('Location: stocks');
}
$st_id = $_GET['st_id'];
$dat = $pdo->query("SELECT * FROM stocks WHERE st_id=" . $st_id);
$a = $dat->fetch();
$title = 'Update Stock';
$content = loadTemplate('templates/editstock_template.php', ['a' => $a]);
