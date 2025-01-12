<?php
include_once "../includes/Database.php";
include_once "../Church/Church.php";

class Attendance {
    public $database;

    public function __construct() {
        $this->database = new Database();
    }

    // Fetch all members
    public function getMembers() {
        $sql = "SELECT ID, name FROM members";
        return $this->database->run($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Render the attendance table
    // Render the attendance table
public function renderAttendanceForm($date) {
    $members = $this->getMembers(); // Fetch all members

    // Start the form
    echo '<form method="POST" action="welcome.php">';
    echo '<input type="hidden" name="date" value="' . htmlspecialchars($date) . '">'; // Hidden field for the date
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
            <th>Member ID</th>
            <th>Name</th>
            <th>Status</th>
          </tr>';

    // Loop through members and render each row
    foreach ($members as $member) {
        // Check if there is an existing attendance record for this member and date
        $sql = "SELECT status FROM attendance WHERE users_id = :users_id AND date = :date";
        $existingRecord = $this->database->run($sql, [
            ':users_id' => $member['ID'],
            ':date' => $date
        ])->fetch();

        // Default to 'Present' if no record found
        $status = isset($existingRecord['status']) ? $existingRecord['status'] : 'Present';

        echo '<tr>';
        echo '<td>' . htmlspecialchars($member['ID']) . '</td>';
        echo '<td>' . htmlspecialchars($member['name']) . '</td>';
        echo '<td>
                <select name="status[' . $member['ID'] . ']">
                    <option value="Present" ' . ($status === 'Present' ? 'selected' : '') . '>Present</option>
                    <option value="Absent" ' . ($status === 'Absent' ? 'selected' : '') . '>Absent</option>
                </select>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
    // Submit button
    echo '<button type="submit">Submit Attendance</button>';
    echo '</form>';
}


}
?>
