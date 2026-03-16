<?php
require_once "classes/Directories.php";

$message = "";
$linkPath = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $folderName = $_POST["folderName"];
    $fileContent = $_POST["fileContent"];

    $directories = new Directories();
    $result = $directories->createDirectoryAndFile($folderName, $fileContent);

    $message = $result["message"];
    $linkPath = $result["link"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File and Directory Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">

    <h1>File and Directory Assignment</h1>
    <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>

    <?php if ($message != "") { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <?php if ($linkPath != "") { ?>
        <p><a href="<?php echo $linkPath; ?>" target="_blank">Path where file is located</a></p>
    <?php } ?>

    <form method="post" action="index.php">
        <div class="mb-3">
            <label for="folderName" class="form-label">Folder Name</label>
            <input type="text" class="form-control" id="folderName" name="folderName">
        </div>

        <div class="mb-3">
            <label for="fileContent" class="form-label">File Content</label>
            <textarea class="form-control" id="fileContent" name="fileContent" rows="8"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>