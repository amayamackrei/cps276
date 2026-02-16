<?php
// even
$numbers = range(1, 50);
$evenNumbers = "Even Numbers: ";

foreach ($numbers as $n) {
    if ($n % 2 === 0) {
        $evenNumbers .= $n . " - ";
    }
}
$evenNumbers = rtrim($evenNumbers, " - ");

// form
$form = <<<FORM
<hr>
<div class="mb-3">
  <label for="emailAddress" class="form-label">Email address</label>
  <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="name@example.com" required>
</div>

<div class="mb-3">
  <label for="exampleTextarea" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleTextarea" name="exampleTextarea" rows="4" required></textarea>
</div>
FORM;

// funct
function createTable($rows, $columns) {
    $table = '<table class="table table-bordered">';

    for ($r = 1; $r <= $rows; $r++) {
        $table .= "<tr>";
        for ($c = 1; $c <= $columns; $c++) {
            $table .= "<td>Row $r, Col $c</td>";
        }
        $table .= "</tr>";
    }

    $table .= "</table>";
    return $table;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Assignment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">
    <?php
        echo $evenNumbers;
        echo $form;
        echo createTable(8, 6);
    ?>
</body>
</html>
