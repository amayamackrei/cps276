<?php
require_once __DIR__ . "/../classes/Db_conn.php";
require_once __DIR__ . "/../classes/Pdo_methods.php";

header('Content-Type: application/json');

$response = array();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (!isset($data['name']) || trim($data['name']) === '') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'No name was provided';
    echo json_encode($response);
    exit;
}

$fullName = trim($data['name']);
$nameParts = explode(' ', $fullName);

if (count($nameParts) < 2) {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Please enter both a first and last name';
    echo json_encode($response);
    exit;
}

$firstName = $nameParts[0];
$lastName = implode(' ', array_slice($nameParts, 1));
$rearrangedName = $lastName . ', ' . $firstName;

$pdo = new PdoMethods();

$sql = "INSERT INTO names (fullname) VALUES (:fullname)";

$bindings = array(
    array(':fullname', $rearrangedName, 'str')
);

$result = $pdo->otherBinded($sql, $bindings);

if ($result === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'There was an error adding the name';
} else {
    $response['masterstatus'] = 'noerror';
    $response['msg'] = 'Name added successfully';
}

echo json_encode($response);
?>