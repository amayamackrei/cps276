<?php

$content = '';

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'login':
            require_once 'views/loginForm.php';
            $content = init();
            break;
        case 'welcome':
            require_once 'views/welcome.php';
            $content = init();
            break;
        case 'addContact':
            require_once 'views/addContactForm.php';
            $content = init();
            break;
        case 'deleteContacts':
            require_once 'views/deleteContactsTable.php';
            $content = init();
            break;
        case 'addAdmin':
            require_once 'views/addAdminForm.php';
            $content = init();
            break;
        case 'deleteAdmins':
            require_once 'views/deleteAdminsTable.php';
            $content = init();
            break;
        default:
            // Invalid page 
            header('Location: index.php?page=login');
            exit;
    }
} else {
    
    header('Location: index.php?page=login');
    exit;
}
?>
