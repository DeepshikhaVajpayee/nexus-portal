<?php
header("Content-Type: application/json");
require_once "../../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$reportType = $data['report_type'] ?? 'Attendance Report';
$reportName = $reportType . " - " . date("F Y");

$stmt = $pdo->prepare("INSERT INTO reports(report_name, report_type) VALUES (?, ?)");
$stmt->execute([$reportName, $reportType]);

echo json_encode([
    "status" => "success",
    "message" => "Report generated successfully",
    "report_name" => $reportName
]);
?>