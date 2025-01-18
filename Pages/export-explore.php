<?php


include_once "../includes/Database.php";


$database = new Database();
$conn = $database->pdo;

if (!$conn) {
    die("Database connection failed.");
}

$query = "SELECT * FROM leadersboard";
$stmt = $conn->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="leaderboard_export.xls"'); 
header('Cache-Control: max-age=0'); // this makes sure we download the file everytime or it stays fresj


$output = fopen('php://output', 'w');


if (!empty($rows)) {
    fputcsv($output, array_keys($rows[0]), "\t"); 
}

// Write data rows
foreach ($rows as $row) {
    fputcsv($output, $row, "\t");
}

fclose($output);
exit;
?>
