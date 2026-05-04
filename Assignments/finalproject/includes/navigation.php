<?php
/**
 * navigation.php
 * Builds the navigation bar based on the user's status.
 * Staff sees: Add Contact, Delete Contact(s), Logout
 * Admin sees: Add Contact, Delete Contact(s), Add Admin, Delete Admin(s), Logout
 */

$nav = '';

if (isset($_SESSION['user_id'])) {
    $nav  = '<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">';
    $nav .= '<div class="container-fluid">';
    $nav .= '<div class="navbar-nav">';
    $nav .= '<a class="nav-link" href="index.php?page=addContact">Add Contact</a>';
    $nav .= '<a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>';

    if ($_SESSION['status'] === 'admin') {
        $nav .= '<a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>';
        $nav .= '<a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>';
    }

    $nav .= '<a class="nav-link" href="logout.php">Logout</a>';
    $nav .= '</div></div></nav>';
}
?>