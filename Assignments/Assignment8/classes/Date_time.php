<?php
require_once __DIR__ . '/Pdo_methods.php';

class Date_time {

    public function checkSubmit() {
        $output = "";

        if (isset($_POST['addNote'])) {
            $output = $this->addNote();
        }
        elseif (isset($_POST['getNotes'])) {
            $output = $this->getNotes();
        }

        return $output;
    }

    private function addNote() {
        if (empty($_POST['dateTime']) || empty($_POST['note'])) {
            return "<p class='text-danger'>You must enter a date, time, and note.</p>";
        }

        $dateTime = $_POST['dateTime'];
        $note = trim($_POST['note']);

        $timestamp = strtotime($dateTime);

        $pdo = new PdoMethods();

        $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note)";
        $bindings = [
            [':date_time', $timestamp, 'int'],
            [':note', $note, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result == 'noerror') {
            return "<p class='text-success'>Note added successfully.</p>";
        } else {
            return "<p class='text-danger'>There was a problem adding the note.</p>";
        }
    }

    private function getNotes() {
        if (empty($_POST['begDate']) || empty($_POST['endDate'])) {
            return "<p class='text-danger'>No notes found for the date range selected.</p>";
        }

        $begDate = strtotime($_POST['begDate'] . " 00:00:00");
        $endDate = strtotime($_POST['endDate'] . " 23:59:59");

        $pdo = new PdoMethods();

        $sql = "SELECT date_time, note 
                FROM note 
                WHERE date_time BETWEEN :begDate AND :endDate 
                ORDER BY date_time DESC";

        $bindings = [
            [':begDate', $begDate, 'int'],
            [':endDate', $endDate, 'int']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if ($records == 'error' || empty($records)) {
            return "<p class='text-danger'>No notes found for the date range selected.</p>";
        }

        $output = "<table class='table table-bordered mt-3'>";
        $output .= "<tr><th>Date and Time</th><th>Note</th></tr>";

        foreach ($records as $row) {
            $formattedDate = date("m/d/Y h:i a", $row['date_time']);
            $note = htmlspecialchars($row['note']);

            $output .= "<tr>";
            $output .= "<td>$formattedDate</td>";
            $output .= "<td>$note</td>";
            $output .= "</tr>";
        }

        $output .= "</table>";

        return $output;
    }
}
?>