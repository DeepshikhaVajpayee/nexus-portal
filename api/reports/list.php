
<?php
require_once "../middleware/auth.php";
header("Content-Type: application/json");
require_once "../../config/database.php";

$stmt = $pdo->prepare("SELECT * FROM reports ORDER BY id DESC");
$stmt->execute();

echo json_encode([
    "status" => "success",
    "reports" => $stmt->fetchAll(PDO::FETCH_ASSOC)
]);
?>