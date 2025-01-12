<?php
include_once "../Church/Attendance.php";
include_once "../includes/Database.php";

$currentDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$timestamp = strtotime($currentDate);

$displayDate = date('l, F j, Y', $timestamp);

$previousSunday = date('Y-m-d', strtotime('-7 days', $timestamp));
$nextSunday = date('Y-m-d', strtotime('+7 days', $timestamp));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $attendanceData = $_POST['status'];
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');  

    foreach ($attendanceData as $memberID => $status) {
        $sql = "SELECT name FROM members WHERE ID = :user_id";
        $member = $database->run($sql, [':user_id' => $memberID])->fetch();

        if ($member) {
            $memberName = $member['name'];

            $sql = "SELECT * FROM attendance WHERE users_id = :users_id AND date = :date";
            $existingRecord = $database->run($sql, [
                ':users_id' => $memberID,
                ':date' => $date
            ])->fetch();

            if ($existingRecord) {
                if ($status === 'Present') {
                    $presentTimes = 1;
                    $absentTimes = 0;
                } else {
                    $presentTimes = 0;
                    $absentTimes = 1;
                }

                $sql = "UPDATE attendance 
                        SET status = :status, present_times = :present_times, absent_times = :absent_times 
                        WHERE users_id = :users_id AND date = :date";
                $params = [
                    ':status' => $status,
                    ':present_times' => $presentTimes,
                    ':absent_times' => $absentTimes,
                    ':users_id' => $memberID,
                    ':date' => $date
                ];
            } else {
                if ($status === 'Present') {
                    $presentTimes = 1;
                    $absentTimes = 0;
                } else {
                    $presentTimes = 0;
                    $absentTimes = 1;
                }

                $sql = "INSERT INTO attendance (users_id, name, status, date, present_times, absent_times) 
                        VALUES (:users_id, :name, :status, :date, :present_times, :absent_times)";
                $params = [
                    ':users_id' => $memberID,
                    ':name' => $memberName,  
                    ':status' => $status,
                    ':date' => $date,
                    ':present_times' => $presentTimes,
                    ':absent_times' => $absentTimes
                ];
            }
            $database->run($sql, $params);
        }
    }

    echo "Attendance updated successfully!";
    header("Location: welcome.php?date=$date"); 
    exit;
}








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="../css/welcome.css">
</head>
<body>

    <div class="navbar">
        <img src="../images/arise-logo-150.png" alt="">
        <a href="../Pages/welcome.php">Attendance</a>
        <a href="../Pages/ranking.php">Rankings</a>
        <a href="../Pages/graph.php">Graphs</a>
        <a href="../Pages/members.php">Members</a>
        <button type="button" id="export">Export</button>
    </div>

    <div class="attendance">
        <div class="date">
            <a href="?date=<?php echo $previousSunday; ?>">
                <ion-icon name="caret-back-outline" class="backward"></ion-icon>
            </a>

            <h1 class="date"><?php echo $displayDate; ?></h1>

            <a href="?date=<?php echo $nextSunday; ?>">
                <ion-icon name="caret-forward-outline" class="forward"></ion-icon>
            </a>
        </div>

        <div class="table">
            <?php
            $attendance = new Attendance();
            $attendance->renderAttendanceForm($currentDate);
            ?>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
