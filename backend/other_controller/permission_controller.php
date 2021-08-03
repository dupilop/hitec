<?php
// require '../db/connect.php';
// session_start();
class permission
{

    function permit($chkfor, $pdo)
    {
        $userid = $_SESSION['id'];
        global $pdo;
        $permission2 = $pdo->prepare("SELECT * FROM permissions WHERE p_a_id=:a_id");
        $permission2->execute(['a_id' => $userid]);
        $perrow = $permission2->rowCount();
        if ($perrow > 0) {
            foreach ($permission2 as $perm) {
                if ($perm[$chkfor] == '1') {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
