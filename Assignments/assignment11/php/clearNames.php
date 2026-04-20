<?php
require_once __DIR__ . "/../classes/Db_conn.php";
require_once __DIR__ . "/../classes/Pdo_methods.php";

header('Content-Type: application/json');

$response = array();

$pdo = new PdoMethods();


$sql = "TRUNCATE TABLE names";


$result = $pdo->otherNotBinded($sql);

// check result 
if ($result === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'There was an error clearing the names';
} else {
    $response['masterstatus'] = 'noerror';
    $response['msg'] = 'All names have been cleared';
}

echo json_encode($response);
?>