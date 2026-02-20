<?php

function addCleanNames() {

    // clicked clear
    if (isset($_POST["clear"])) {
        return "";
    }

    $namesString = $_POST["namelist"];

    $namesArray = [];

    // already names, split into array
    if ($namesString != "") {
        $namesArray = explode("\n", $namesString);
    }

    // new name
    $newName = $_POST["name"];

    // split fname, lname
    $parts = explode(" ", $newName);

    $first = $parts[0];
    $last = $parts[1];

    // capital first letter
    $first = ucfirst(strtolower($first));
    $last = ucfirst(strtolower($last));

    // lname, fname
    $formatted = $last . ", " . $first;

    // add to array
    array_push($namesArray, $formatted);

    // sort A-Z
    sort($namesArray);

    $output = implode("\n", $namesArray);
    return $output;
}