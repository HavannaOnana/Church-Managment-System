<?php


include_once "../Church/Church.php";

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $email = htmlspecialchars($_POST['email']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);

    if(!empty($name)&& !empty($age) && !empty($email) && !empty($phonenumber)){
        $member = new Church();
        $member->AddMember($name,$age,$email,$phonenumber);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="../css/addmember.css">
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

     <div class="addMemeber">
        <h1>Add a Memeber</h1>
        <form action="members.php" method="post">
            <label for="name" name="name">Name of Member</label><br>
            <input type="text" name="name"><br><br>
            <label for="age" name="age">Age</label><br>
            <input type="text" name="age"><br><br>
            <label for="email" name="email">Email</label><br>
            <input type="text" name="email"><br><br>
            <label for="phonenumber" name="phonenumber">Phone Number</label><br>
            <input type="text" name="phonenumber"><br><br>
            <button type="submit">Add Member</button>
        </form>
     </div>
    
</body>
</html>