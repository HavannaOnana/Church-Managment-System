<?php

include_once "../includes/Database.php";

class Graph {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }


    public function getAttendanceData() {
        $sql = "SELECT date, COUNT(*) as total_present 
                FROM attendance 
                WHERE status = 'Present'
                GROUP BY date 
                ORDER BY total_present DESC";
        return $this->database->run($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getTotalStudents() {
        $sql = "SELECT COUNT(*) as total_students FROM members";
        return $this->database->run($sql)->fetch(PDO::FETCH_ASSOC)['total_students'];
    }
}

$graph = new Graph();
$data = $graph->getAttendanceData();
$totalStudents = $graph->getTotalStudents(); // Total number of students

$dates = [];
$totals = [];

// Prepare data for the graph
foreach ($data as $row) {
    $dates[] = $row['date'];
    $totals[] = $row['total_present'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
    <link rel="stylesheet" href="../css/graph.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="navbar">
        <img src="../images/arise-logo-150.png" alt="">
        <a href="../Pages/welcome.php">Attendance</a>
        <a href="../Pages/ranking.php">Rankings</a>
        <a href="../Pages/graph.php">Graphs</a>
        <a href="../Pages/addmember.php">Add Members</a>
        <button type="button" id="export"><a href="../Pages/explore.php">Explore</a></button>
    </div>

    <h1>The Graph </h1>
    <p>The graph under shows which days most students were present</p>

    <div class="chart-container" style="width: 80%; margin: 0 auto; padding: 50px;">
        <canvas id="attendanceChart"></canvas>
    </div>

    <script>
        
        const labels = <?php echo json_encode($dates); ?>;
        const data = <?php echo json_encode($totals); ?>;
        const totalStudents = <?php echo json_encode($totalStudents); ?>;

        const config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Present Students',
                        data: data,
                        backgroundColor: 'rgba(10, 97, 97, 0.89)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render the graph
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, config);
    </script>

</body>
</html>
