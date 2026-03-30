<?php
require_once __DIR__ . '/../classes/Pdo_methods.php';

$output = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fileName = $_POST['file_name'];
    $pdfFile = $_FILES['pdf_file'];

    if ($pdfFile['size'] > 100000) {
        $message = "<p class='text-danger'>File is too large. File must be under 100000 bytes.</p>";
    }
    elseif ($pdfFile['type'] != 'application/pdf') {
        $message = "<p class='text-danger'>File must be a PDF file.</p>";
    }
    else {
        $uploadPath = "files/" . basename($pdfFile['name']);

        if (move_uploaded_file($pdfFile['tmp_name'], $uploadPath)) {

            $pdo = new PdoMethods();

            $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (:file_name, :file_path)";

            $bindings = [
                [':file_name', $fileName, 'str'],
                [':file_path', $uploadPath, 'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result == 'noerror') {
                $message = "<p class='text-success'>File uploaded successfully.</p>";
            } else {
                $message = "<p class='text-danger'>There was a problem saving the file information to the database.</p>";
            }

        } else {
            $message = "<p class='text-danger'>There was a problem uploading the file to the server.</p>";
        }
    }
}

$output .= "
<h1>File Upload</h1>
<p><a href='listFiles.php'>Show File List</a></p>
$message
<form method='post' action='' enctype='multipart/form-data'>
    <div class='mb-3'>
        <label for='file_name' class='form-label'>File Name</label>
        <input type='text' class='form-control' name='file_name' id='file_name'>
    </div>

    <div class='mb-3'>
        <input type='file' class='form-control' name='pdf_file' id='pdf_file'>
    </div>

    <button type='submit' class='btn btn-primary'>Upload File</button>
</form>
";
?>