<?php
require_once 'classes/Pdo_methods.php';

function processDeleteContacts() {
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
                if ($result !== 'noerror') $allDeleted = false;
            }
            $msg = $allDeleted
                ? '<p class="text-success">Contact(s) deleted</p>'
                : '<p class="text-danger">Could not delete the contacts</p>';
        }
    }

    $sql = "SELECT * FROM contacts";
    $records = $pdo->selectNotBinded($sql);
    if ($records === 'error') $records = [];

    return ['msg' => $msg, 'records' => $records];
}
?>