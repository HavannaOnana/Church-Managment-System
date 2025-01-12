<?php

include_once "../Church/Church.php";

$Member = new Church();

if(isset($_GET['id'])){
    echo $member_ID = $_GET['id'];

    $member = $Member->GetMemberByID($member_ID);

    if(!$member){
        die("Member not found");
    }else{
        die("No member provided");
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a Member</title>
    <link rel="stylesheet" href="">
</head>
<body>


     <h1>Update Member of Arise</h1>
     <form action="" method="POST">
        <label for="name">Name</label><br>
        <input type="text" id="name">
     </form>
    
</body>
</html>