<?php

include_once "../includes/Database.php";
include_once "../Church/Church.php";

$Member = new Church();

if (isset($_GET['id'])) {
    $member_ID = $_GET['id']; // Get the ID from the URL

    // Fetch the member details using the ID
    $member = $Member->GetMemberByID($member_ID);

    if (!$member) {
        die("Member not found");
    }
} else {
    die("No member ID provided.");
}

// Handle form submission to update the member
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    $updateStatus = $Member->updateMember($member_ID, $name, $age, $email, $phonenumber);

    if ($updateStatus) {
        echo "Member updated successfully!";
        header("Location: ../Pages/members.php");
        exit;
    } else {
        echo "Failed to update member.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Member</title>
    <link rel="stylesheet" href="../css/members.css">
</head>
<div class="body">
    <h1>Update Member</h1>
    <form action="" method="POST">
        <label for="name" name="name">Name</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required><br><br>

        <label for="age">Age</label><br>
        <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($member['age']); ?>" required><br><br>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required><br><br>

        <label for="phonenumber">Phone Number</label><br>
        <input type="text" id="phonenumber" name="phonenumber" value="<?php echo htmlspecialchars($member['phonenumber']); ?>" required><br><br>

        <button type="submit">Update Member</button>
    </form>
</div>
</html>
