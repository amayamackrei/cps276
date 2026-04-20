<?php
require_once __DIR__ . "/../classes/Db_conn.php";
require_once __DIR__ . "/../classes/Pdo_methods.php";

header('Content-Type: application/json');

$response = array();

$pdo = new PdoMethods();

$sql = "SELECT fullname FROM names ORDER BY fullname ASC";

$result = $pdo->selectNotBinded($sql);

if ($result === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'There was an error retrieving the names';
} else {

    $namesHtml = '';
    
    if (count($result) === 0) {
        $namesHtml = '<p>No names to display</p>';
    }
        foreach ($result as $row) {
            $namesHtml .= '<p>' . htmlspecialchars($row['fullname']) . '</p>';
        }
    }
    
    $response['masterstatus'] = 'noerror';
    $response['names'] = $namesHtml;
}

echo json_encode($response);
?>