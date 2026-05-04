<?php


//page requested?
$requestedPage = $_GET['page'] ?? 'login';

// n/a login
$publicPages = ['login'];

//admin only
$adminOnlyPages = ['addAdmin', 'deleteAdmins'];

//staff or admin can access
$loggedInPages = ['welcome', 'addContact', 'deleteContacts'];

if (!in_array($requestedPage, $publicPages)) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    //verify status
    if (in_array($requestedPage, $adminOnlyPages)) {
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
    }
}
?>