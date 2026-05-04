<?php
/**
 * welcome.php
 * Welcome page shown after a successful login.
 */

function init() {
    $userName = $_SESSION['name'] ?? '';
    ob_start();
    ?>
    <h1>Welcome Page</h1>
    <p>Welcome <?php echo htmlspecialchars($userName); ?></p>
    <?php
    return ob_get_clean();
}
?>