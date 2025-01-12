<?php

include_once "../includes/Database.php";

class Ranking {

    public $database;

    public function __construct() {
        $this->database = new Database();
    }

    // Method to update rankings
    public function updateRankings() {
        // Fetch aggregated attendance data
        $sql = "SELECT name, 
                       SUM(present_times) AS totalpresent, 
                       SUM(absent_times) AS totalabsent 
                FROM attendance 
                GROUP BY name";
        $attendanceData = $this->database->run($sql)->fetchAll(PDO::FETCH_ASSOC);

        // Update the rankings table
        foreach ($attendanceData as $row) {
            $name = $row['name'];
            $totalPresent = $row['totalpresent'];
            $totalAbsent = $row['totalabsent'];

            // Check if the user already exists in the ranking table
            $checkSql = "SELECT * FROM leadersboard WHERE name = :name";
            $checkParams = [':name' => $name];
            $existing = $this->database->run($checkSql, $checkParams)->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                // Update existing record
                $updateSql = "UPDATE leadersboard 
                              SET totalpresent = :totalpresent, totalabsent = :totalabsent 
                              WHERE name = :name";
                $updateParams = [
                    ':totalpresent' => $totalPresent,
                    ':totalabsent' => $totalAbsent,
                    ':name' => $name,
                ];
                $this->database->run($updateSql, $updateParams);
            } else {
                // Insert new record
                $insertSql = "INSERT INTO leadersboard (name, totalpresent, totalabsent) 
                              VALUES (:name, :totalpresent, :totalabsent)";
                $insertParams = [
                    ':name' => $name,
                    ':totalpresent' => $totalPresent,
                    ':totalabsent' => $totalAbsent,
                ];
                $this->database->run($insertSql, $insertParams);
            }
        }
    }

    // Method to fetch rankings for display
    public function getRankings() {
        $sql = "SELECT * FROM leadersboard ORDER BY totalpresent DESC, totalabsent ASC";
        return $this->database->run($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
