<?php
require_once __DIR__ . '/classes/Db_conn.php';
require_once __DIR__ . '/classes/Pdo_methods.php';
require_once __DIR__ . '/classes/Validation.php';

$pdo = new PdoMethods();
$validate = new Validation();

$firstName = "";
$lastName = "";
$email = "";
$password = "";
$confirmPassword = "";

$firstNameError = "";
$lastNameError = "";
$emailError = "";
$passwordError = "";
$confirmPasswordError = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $hasError = false;

    if (empty($firstName)) {
        $firstNameError = "You must enter a first name and it must be alpha characters only.";
        $hasError = true;
    } elseif (!$validate->checkFormat($firstName, 'name')) {
        $firstNameError = "You must enter a first name and it must be alpha characters only.";
        $hasError = true;
    }

    if (empty($lastName)) {
        $lastNameError = "You must enter a last name and it must be alpha characters only.";
        $hasError = true;
    } elseif (!$validate->checkFormat($lastName, 'name')) {
        $lastNameError = "You must enter a last name and it must be alpha characters only.";
        $hasError = true;
    }

    if (empty($email)) {
        $emailError = "You must enter a email address and it must be in the format of example@example.com.";
        $hasError = true;
    } elseif (!$validate->checkFormat($email, 'email')) {
        $emailError = "You must enter a email address and it must be in the format of example@example.com.";
        $hasError = true;
    }

    if (empty($password)) {
        $passwordError = "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)";
        $hasError = true;
    } elseif (!$validate->checkFormat($password, 'password')) {
        $passwordError = "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)";
        $hasError = true;
    }

    if (empty($confirmPassword)) {
        $confirmPasswordError = "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)";
        $hasError = true;
    } elseif (!$validate->checkFormat($confirmPassword, 'password')) {
        $confirmPasswordError = "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)";
        $hasError = true;
    }

    if (!$hasError && $password !== $confirmPassword) {
        $confirmPasswordError = "Your passwords do not match";
        $hasError = true;
    }

    if (!$hasError) {
        $sql = "SELECT email FROM users WHERE email = :email";
        $bindings = [
            [':email', $email, 'str']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if (!empty($records)) {
            $message = "<p>There is already a record with that email</p>";
            $hasError = true;
        }
    }

    if (!$hasError) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, password)
                VALUES (:first_name, :last_name, :email, :password)";

        $bindings = [
            [':first_name', $firstName, 'str'],
            [':last_name', $lastName, 'str'],
            [':email', $email, 'str'],
            [':password', $hashedPassword, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result == 'noerror') {
            $message = "<p>You have been added to the database</p>";

            $firstName = "";
            $lastName = "";
            $email = "";
            $password = "";
            $confirmPassword = "";
        } else {
            $message = "<p>There was a problem adding the record.</p>";
        }
    }
}

$sql = "SELECT first_name, last_name, email, password FROM users";
$records = $pdo->selectNotBinded($sql);

$tableOutput = "";

if (!empty($records) && $records != 'error') {
    $tableOutput .= "<table class='table table-bordered mt-3'>";
    $tableOutput .= "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th></tr>";

    foreach ($records as $row) {
        $tableOutput .= "<tr>";
        $tableOutput .= "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        $tableOutput .= "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        $tableOutput .= "<td>" . htmlspecialchars($row['email']) . "</td>";
        $tableOutput .= "<td>" . htmlspecialchars($row['password']) . "</td>";
        $tableOutput .= "</tr>";
    }

    $tableOutput .= "</table>";
} else {
    $tableOutput = "<p>No records to display.</p>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-3">
    <p>All fields are required.</p>
    <?php echo $message; ?>

    <form method="post" action="" novalidate>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">*First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
                <span class="text-danger"><?php echo $firstNameError; ?></span>
            </div>

            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">*Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
                <span class="text-danger"><?php echo $lastNameError; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">*Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="col-md-4 mb-3">
                <label for="password" class="form-label">*Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                <span class="text-danger"><?php echo $passwordError; ?></span>
            </div>

            <div class="col-md-4 mb-3">
                <label for="confirm_password" class="form-label">*Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo htmlspecialchars($confirmPassword); ?>">
                <span class="text-danger"><?php echo $confirmPasswordError; ?></span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <?php echo $tableOutput; ?>
</body>
</html>