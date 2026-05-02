<?php
header("Content-Type: application/json");
require_once "../../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$title = $data['title'] ?? '';
$description = $data['description'] ?? '';
$priority = $data['priority'] ?? 'Medium';

if($title == '' || $description == ''){
    echo json_encode(["status"=>"error","message"=>"Title and description required"]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO tickets(title, description, priority) VALUES (?, ?, ?)");
$stmt->execute([$title, $description, $priority]);

echo json_encode(["status"=>"success","message"=>"Ticket created"]);
?>