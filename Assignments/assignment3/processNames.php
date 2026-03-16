<?php

function addClearNames() : string
{
    $button = $_POST["btn"] ?? "";
    $currentList = $_POST["namelist"] ?? "";
 // clear name
    if ($button === "clear") {
        return "";
    }

    // add a name
    $fullName = $_POST["fullname"] ?? "";
    $fullName = trim($fullName);

    // Split into array \n
    $namesArray = [];
    if (trim($currentList) !== "") {
        $namesArray = explode("\n", trim($currentList));
    }

    // first last
    $parts = explode(" ", $fullName);
    $first = $parts[0] ?? "";
    $last  = $parts[1] ?? "";

    // capital first letter
    $first = ucfirst(strtolower($first));
    $last  = ucfirst(strtolower($last));

    // convert to "Last, First"
    $formatted = $last . ", " . $first;

    // add
    $namesArray[] = $formatted;

    // sort alphabetically 
    sort($namesArray);

    return implode("\n", $namesArray);
}