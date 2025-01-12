<?php

// time code and everything 
$currentDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');


$timestamp = strtotime($currentDate);

$displayDate = date('l, F j, Y', $timestamp);

$previousSunday = date('Y-m-d', strtotime('-7 days', $timestamp));
$nextSunday = date('Y-m-d', strtotime('+7 days', $timestamp));


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
        <a href="../Pages/welcome.php">attendance</a>
        <a href="#">rankings</a>
        <a href="#">graphs</a>
        <a href="../Pages/members.php">members</a>
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
</div>
    

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>