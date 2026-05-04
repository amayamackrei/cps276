<?php

require_once 'classes/Pdo_methods.php';

$loginMsg = '';
$emailValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $emailValue = $email;

    if (empty($email) || empty($password)) {
        $loginMsg = '<p class="text-danger">Email and password are required.</p>';
    } else {
        $pdo = new PdoMethods();
        $sql = "SELECT id, name, email, password, status FROM admins WHERE email = :email";
        $bindings = [[':email', $email, 'str']];
        $result = $pdo->selectBinded($sql, $bindings);

        if ($result === 'error') {
            $loginMsg = '<p class="text-danger">There was an error processing your login.</p>';
        } elseif (empty($result)) {
            $loginMsg = '<p class="text-danger">Invalid email or password.</p>';
        } else {
            $user = $result[0];
            if (password_verify($password, $user['password'])) {
                // Login success 
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name']    = $user['name'];
                $_SESSION['email']   = $user['email'];
                $_SESSION['status']  = $user['status'];
                header('Location: index.php?page=welcome');
                exit;
            } else {
                $loginMsg = '<p class="text-danger">Invalid email or password.</p>';
            }
        }
    }
}
?>
