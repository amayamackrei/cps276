<?php

function init() {
    require_once 'controllers/loginProc.php';
    global $loginMsg, $emailValue;

    ob_start();
    ?>
    <h1>Login</h1>
    <?php echo $loginMsg; ?>
    <form method="post" action="index.php?page=login">
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($emailValue); ?>">
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php
    return ob_get_clean();
}
?>