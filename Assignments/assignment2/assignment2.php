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

<!-- 1. The assignment specifies "all PHP written at the top above the HTML DOCtpye. Explain the implications of this placement 
 on how the server processes the page. What advantage does generating all PHP variables before any HTML output provide in 
 terms of execution flow?
 2. Beyond simply finding even numbers, describe a scenario when you would use a similiar foreach loop with a conditional (if) 
 statement to filter or process elements from an array based on different criteria like finding all numbers divisable by 7
 3. Discuss the primary benefits of using heredoc for embedding large blocks of HTML or other text within PHP strings, especially 
 when that text contains quotes or multiple lines. How does it improve code readability compared to concatenating strings with
 double quotes?
 4.The createTable funct uses nested loops to build the table. Describe the role each loop: which one is responsible for iterating
 through the rows, and which for the columns? How does the concatenation (.=) inside these loops incrementally build the complete 
 HTML table strings?
 5. The createTable() funct returns a string that is later echoed, rather than echoing directly inside the funct. Explain the benefits
 this approach. How does the returning value make the funct more reusale and flexible compared to having the funct echo directly? What
 are the implications for testing or reusing this funct in different contexts?