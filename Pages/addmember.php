<?php
// Include your classes
include_once "../Church/Church.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $email = htmlspecialchars($_POST['email']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);

    // Validate the inputs (if they are not empty)
    if (!empty($name) && !empty($age) && !empty($email) && !empty($phonenumber)) {
        $member = new Church();
        
        // Add the member to the database
        $success = $member->AddMember($name, $age, $email, $phonenumber);
        
        if ($success) {
            header('Location: members.php');
            exit;
        } else {
            echo "Failed to add member. Please try again.";
        }
    } else {
        echo "All fields are required!";
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
        <h1>Add a Member</h1>
        <form action="addmember.php" method="post">
            <label for="name">Name of Member</label><br>
            <input type="text" name="name" id="name" required><br><br>

            <label for="age">Age</label><br>
            <input type="text" name="age" id="age" required><br><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" required><br><br>

            <label for="phonenumber">Phone Number</label><br>
            <input type="text" name="phonenumber" id="phonenumber" required><br><br>

            <button type="submit">Add Member</button>
        </form>
     </div>
    
</body>
</html>
