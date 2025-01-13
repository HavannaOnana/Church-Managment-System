<?php

include_once "../includes/Database.php";
include_once "../Church/Church.php";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="../css/members.css">
</head>
<body>

     <div class="navbar">
        <img src="../images/arise-logo-150.png" alt="">
        <a href="../Pages/welcome.php">Attendance</a>
        <a href="../Pages/ranking.php">Rankings</a>
        <a href="../Pages/graph.php">Graphs</a>
        <a href="../Pages/addmember.php">Add Members</a>
        <button type="button" id="export">Export</button>
    </div>

     <div class="showMembers">
         <h1>List of Members</h1>
         <?php
           $members = new Church();
           $members->renderMembers();
         ?>
     </div>
    
</body>
</html>