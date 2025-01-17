<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Leaderboard</title>
    <link rel="stylesheet" href="../css/styles.css">
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


    <div class="content">
        <h1>Export Leaderboard</h1>
        <form method="GET" action="export-explore.php">
            <button type="submit" class="export-button">Download Leaderboard</button>
        </form>
    </div>
</body>
</html>
