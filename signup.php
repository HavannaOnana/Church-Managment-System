<?php



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $password = $_POST['password'];

    if($password === "102488"){
        session_start();
        header("Location: ./Pages/welcome.php");
        exit;
    }else{
        $error = "Invalid password. Please try again.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    <div class="form">
        <img src="./images/signout.png" alt="">
        <form action="" method="post">
            <img src="./images/arise-logo-150.png" alt="">
             <h1>Log In</h1>
            <label for="password" name="password" id="password"></label><br>
            <input type="text" placeholder="password" name="password" for="password"><br><br>
            <button type="submit">Submit</button>
            <p class="text">
               After logging in, you can add new members, check how many times a<br>
                member has been present, view attendance data through graphs, access a ranking<br>
                 system for attendance, and export attendance data to an Excel file.
            </p>
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

