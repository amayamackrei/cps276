<?php
$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "processNames.php";
    $output = addClearNames();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <title>Add Names</title>
</head>

<body class="container">
    <main class="mt-3">

        <h1 class="display-5 fw-bold">Add Names</h1>

        <form method="post" action="index.php">

            <div class="mb-2">
                <button type="submit" name="btn" value="add" class="btn btn-primary me-2">Add Name</button>
                <button type="submit" name="btn" value="clear" class="btn btn-primary">Clear Names</button>
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">Enter Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                       value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label for="namelist" class="form-label">List of Names</label>

                <!-- THIS is the exact “extra PHP block” your assignment mentions -->
                <textarea style="height: 500px;" class="form-control"
id="namelist" name="namelist"><?php echo $output ?></textarea>
            </div>

        </form>
    </main>
</body>
</html>