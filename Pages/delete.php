<?php
include_once "../Church/Church.php";

$Member = new Church();

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $memberID = $_GET['id'];

    // Handle form submission to confirm deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['confirm'])) {
            // Attempt to delete the member
            $deleteStatus = $Member->deleteMember($memberID);

            if ($deleteStatus) {
                echo "Member deleted successfully!";
                header("Location: ../Pages/members.php");
                exit;
            } else {
                echo "Failed to delete member.";
            }
        } else {
            // User canceled the deletion
            header("Location: ../Pages/members.php");
            exit;
        }
    }
} else {
    echo "No Member ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Member</title>
    <link rel="stylesheet" href="../css/members.css">
</head>
<body class="body">
    <h1>Are you sure you want to delete this member?</h1>
    <form action="" method="POST">
        <button type="submit" name="confirm">Yes, Delete</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
