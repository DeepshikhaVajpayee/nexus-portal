<?php
header("Content-Type: application/json");
require_once "../../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);
$uid = trim($data["uid"] ?? "");

if ($uid === "") {
    echo json_encode(["status"=>"error", "message"=>"RFID UID missing"]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM employees WHERE rfid_uid = ?");
$stmt->execute([$uid]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    echo json_encode(["status"=>"error", "message"=>"Employee not found"]);
    exit;
}

$last = $pdo->prepare("
    SELECT status FROM attendance_logs 
    WHERE employee_id = ? 
    ORDER BY id DESC 
    LIMIT 1
");
$last->execute([$employee["id"]]);
$lastLog = $last->fetch(PDO::FETCH_ASSOC);

$status = "Checked In";

if ($lastLog && $lastLog["status"] === "Checked In") {
    $status = "Checked Out";
}

$insert = $pdo->prepare("
    INSERT INTO attendance_logs(employee_id, status) 
    VALUES (?, ?)
");
$insert->execute([$employee["id"], $status]);

echo json_encode([
    "status"=>"success",
    "message"=>"Attendance marked successfully",
    "employee"=>$employee["name"],
    "department"=>$employee["department"],
    "attendance_status"=>$status
]);
?>