<?php
require_once __DIR__ . '/../classes/Pdo_methods.php';

$output = "<h1>List Files</h1>";
$output .= "<p><a href='index.php'>Add File</a></p>";
$output .= "<ul>";

$pdo = new PdoMethods();

$sql = "SELECT file_name, file_path FROM pdf_files";
$records = $pdo->selectNotBinded($sql);

if ($records != 'error' && !empty($records)) {
    foreach ($records as $row) {
        $name = $row['file_name'];
        $path = $row['file_path'];
        $output .= "<li><a target='_blank' href='$path'>$name</a></li>";
    }
} else {
    $output .= "<li>No files found.</li>";
}

$output .= "</ul>";
?>