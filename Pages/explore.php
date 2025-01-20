<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Leaderboard</title>
    <link rel="stylesheet" href="../css/export.css">
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
        <p>Once you click the button below , an excel 
            sheet will be automatically downloaded for <br>
            you.
        </p>
        <form method="GET" action="export-explore.php">
            <button type="submit" class="export-button">Download Leaderboard</button>
        </form>
    </div>

    <div class="footer">
        <h2>Negative One</h2>
        <div class="icon">
            <ion-icon name="logo-facebook"></ion-icon>
            <ion-icon name="logo-google"></ion-icon>
            <ion-icon name="logo-pinterest"></ion-icon>
            <ion-icon name="logo-laravel"></ion-icon>
            <ion-icon name="logo-github"></ion-icon>
        </div>
        <p>Negative One is a creative individual passionate about crafting designs,<br>
         building websites, and continuously learning<br> new skills to improve and serve others better.</p>
    </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
