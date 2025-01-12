<?php

include_once "../Church/Ranking.php";

$ranking = new Ranking();
$ranking->updateRankings(); // Update rankings before displaying
$rankings = $ranking->getRankings(); // Fetch updated rankings

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rankings Page</title>
    <link rel="stylesheet" href="../css/ranking.css">
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

    <div class="ranking">
        <h1>Rankings</h1>
        <table border="" cellpadding="15" cellspacing="0">
            <tr>
                <th class="position">#</th>
                <th>Name</th>
                <th class="TP">Total Present</th>
                <th class="TA">Total Absent</th>
            </tr>
            <?php
            $rank = 1;
            foreach ($rankings as $row) {
                echo "<tr>";
                echo "<td class='rankcell'>" . $rank++ . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td class='bold'>" . htmlspecialchars($row['totalpresent']) . "</td>";
                echo "<td class='bold'>" . htmlspecialchars($row['totalabsent']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
