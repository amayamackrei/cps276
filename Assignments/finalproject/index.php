<?php
/**
 * index.php
 * Main entry point for the application.
 * Starts the session, runs the security check, routes to the appropriate view,
 * and outputs the final HTML.
 */

session_start();

// Security check (redirects if user lacks access)
require_once 'includes/security.php';

// Build navigation (will be empty if not logged in)
require_once 'includes/navigation.php';

// Route to the requested view (sets $content)
require_once 'routes/router.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <?php echo $nav; ?>
        <?php echo $content; ?>
    </div>
</body>
</html>