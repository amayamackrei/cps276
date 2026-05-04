<?php


require_once 'classes/Pdo_methods.php';

$msg = '';
$pdo = new PdoMethods();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (isset($_POST['chkbx']) && is_array($_POST['chkbx']) && count($_POST['chkbx']) > 0) {
        $allDeleted = true;
        foreach ($_POST['chkbx'] as $id) {
            $idInt = (int)$id;
            // no deleting own account
            if ($idInt === (int)($_SESSION['user_id'] ?? 0)) {
                continue;
            }
            $sql = "DELETE FROM admins WHERE id = :id";
            $bindings = [[':id', $idInt, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            if ($result !== 'noerror') {
                $allDeleted = false;
            }
        }

        if ($allDeleted) {
            $msg = '<p class="text-success">Admin(s) deleted</p>';
        } else {
            $msg = '<p class="text-danger">Could not delete the admins</p>';
        }
    }
}

// retrieve all admins 
$sql = "SELECT * FROM admins";
$records = $pdo->selectNotBinded($sql);

if ($records === 'error') {
    $records = [];
}
?>
