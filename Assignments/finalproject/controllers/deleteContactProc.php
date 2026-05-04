<?php


require_once 'classes/Pdo_methods.php';

$msg = '';
$pdo = new PdoMethods();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (isset($_POST['chkbx']) && is_array($_POST['chkbx']) && count($_POST['chkbx']) > 0) {
        $allDeleted = true;
        foreach ($_POST['chkbx'] as $id) {
            $idInt = (int)$id;
            $sql = "DELETE FROM contacts WHERE id = :id";
            $bindings = [[':id', $idInt, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            if ($result !== 'noerror') {
                $allDeleted = false;
            }
        }

        if ($allDeleted) {
            $msg = '<p class="text-success">Contact(s) deleted</p>';
        } else {
            $msg = '<p class="text-danger">Could not delete the contacts</p>';
        }
    }
   
}

// retrieve
$sql = "SELECT * FROM contacts";
$records = $pdo->selectNotBinded($sql);

if ($records === 'error') {
    $records = [];
}
?>
