<?php
header("Content-Type: application/json");
require_once "../../config/database.php";

$stmt = $pdo->prepare("SELECT * FROM tickets ORDER BY id DESC");
$stmt->execute();

echo json_encode([
    "status" => "success",
    "tickets" => $stmt->fetchAll(PDO::FETCH_ASSOC)
]);
?>