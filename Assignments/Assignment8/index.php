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
    <title>Add Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-3">
    <h1>Add Note</h1>
    <p><a href="display_notes.php">Display Notes</a></p>

    <?php echo $notes; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="dateTime" class="form-label">Date and Time</label>
            <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note" rows="12"></textarea>
        </div>

        <button type="submit" name="addNote" class="btn btn-primary">Add Note</button>
    </form>
</body>
</html>