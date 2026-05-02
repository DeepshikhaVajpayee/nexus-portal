<?php

header("Content-Type: application/json");

require_once "../../config/database.php";

$stmt = $pdo->prepare("
    SELECT 
        attendance_logs.id,
        employees.name,
        employees.department,
        attendance_logs.status,
        attendance_logs.scan_time
    FROM attendance_logs
    JOIN employees ON attendance_logs.employee_id = employees.id
    ORDER BY attendance_logs.id DESC
");

$stmt->execute();

$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "success",
    "logs" => $logs
]);

?>