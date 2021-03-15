<?php
session_start();
require '../../db/connect.php';
require '../../classes/databasetable.php';
$rr = new DatabaseTable('notifications');
$ns2 = new DatabaseTable('notification_status');
if ($_POST['action'] == 'pushnotification') {
    $assignedto = $_POST['assignedto'];
    $rr2 = $pdo->prepare("SELECT * FROM roles_assign ra 
    INNER JOIN roles r ON r.r_id=ra.ras_r_id WHERE r_name=:user_type");
    $rr2->execute(['user_type' => $assignedto]);
    $rrr2 = $rr2->fetchAll();
    unset($_POST['action'], $_POST['assignedto']);
    $_POST['n_uploaddate'] = date('Y-m-d H:i:sa');
    $abc1 = $rr->save($_POST, '');
    $n_l_id = $pdo->lastInsertId();

    foreach ($rrr2 as $rrrr2) {
        $n_id = $n_l_id;
        $ns_ad_id = $rrrr2['ras_a_id'];
        $ns_status = 'unread';
        $criteria = [
            'n_id' => $n_id,
            'ns_ad_id' => $ns_ad_id,
            'ns_status' => $ns_status
        ];
        $abc2 = $ns2->save($criteria, '');
    }
} else if ($_POST['action'] == 'removenotification') {
    unset($_POST['action']);
    $abc3 = $rr->delete('n_id', $_POST['id']);
} else if ($_POST['action'] == 'view') {
    $output = '<table class="table table-hover table-sm" id="example">
    <thead>
        <tr>
            <th>#</th>
            <th>Message</th>
            <th>Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    $ag = $rr->findAll();
    $aggg = $ag->fetchAll();
    $a = 1;
    foreach ($aggg as $agg) {
        $cc = $pdo->prepare("SELECT COUNT(*) FROM notification_status WHERE n_id=:n_id");
        $cc->execute(['n_id' => $agg['n_id']]);
        $ccc = $cc->fetch();

        $cc2 = $pdo->prepare("SELECT COUNT(*) FROM notification_status WHERE n_id=:n_id && ns_status='read'");
        $cc2->execute(['n_id' => $agg['n_id']]);
        $ccc2 = $cc2->fetch();
        if ($ccc[0] > 0) {
            $inper = ($ccc2[0] / $ccc[0]) * 100;
        } else {
            $inper = 0;
        }
        $output .= '<tr>
            <td>' . $a . '</td>
            <td>' . $agg['n_text'] . '</td>
            
            <td><div class="row align-items-center my-2"><div class="col-12 col-xl-10 my-3">
                         
                          <div class="progress my-2" style="height: 5px;">
                          
                            <div class="progress-bar" role="progressbar" style="width: ' . number_format($inper, 2) . '%" aria-valuenow="' . number_format($inper, 2) . '" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3 text-left">
                          <span class="my-0 text-muted small">' . number_format($inper, 0) . '% viewed</span>
                        </div></div></td>
            <td><button class="btn btn-danger removenotification" id="' . $agg['n_id'] . '">Delete</button></td>
        </tr>';
        $a++;
    }

    $output .= '</tbody>
    
    </table>';
    echo $output;
}
