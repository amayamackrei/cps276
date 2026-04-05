<?php
require_once __DIR__ . '/classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-3">
    <h1>Display Notes</h1>
    <p><a href="index.php">Add Note</a></p>

    <?php echo $notes; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="begDate" class="form-label">Beginning Date</label>
            <input type="date" class="form-control" id="begDate" name="begDate">
        </div>

        <div class="mb-3">
            <label for="endDate" class="form-label">Ending Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>

        <button type="submit" name="getNotes" class="btn btn-primary">Get Notes</button>
    </form>
</body>
</html>