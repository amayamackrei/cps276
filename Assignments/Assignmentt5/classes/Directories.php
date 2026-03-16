<?php

class Directories {

    public function createDirectoryAndFile($folderName, $fileContent) {

        $result = [
            "message" => "",
            "link" => ""
        ];

        $baseDirectory = "directories/" . $folderName;
        $filePath = $baseDirectory . "/readme.txt";

        // Check if directory already exists
        if (is_dir($baseDirectory)) {
            $result["message"] = "A directory already exists with that name.";
            return $result;
        }

        // Try to create the directory
        if (!mkdir($baseDirectory, 0777)) {
            $result["message"] = "There was a problem creating the directory.";
            return $result;
        }

        chmod($baseDirectory, 0777);

        // Try to create the file and write content
        if (file_put_contents($filePath, $fileContent) === false) {
            $result["message"] = "There was a problem creating the file.";
            return $result;
        }

        chmod($filePath, 0666);

        $result["message"] = "File and directory where created";
        $result["link"] = $filePath;

        return $result;
    }
}