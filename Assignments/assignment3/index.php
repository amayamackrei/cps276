<?php
$output = "";
if (isset($_GET['namelist'])) {
    $output = $_GET['namelist'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">

    <h1 class="mt-4 mb-4">Name List Form</h1>

    <form action="processNames.php" method="post">

        <div class="mb-3">
            <label for="namelist" class="form-label">List of Names</label>
            <textarea style="height: 500px;" class="form-control"
            id="namelist" name="namelist"><?php echo $output ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</body>
</html>