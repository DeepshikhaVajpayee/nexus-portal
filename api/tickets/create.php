<?php

header("Content-Type: application/json");

require_once "../../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$title = trim($data['title'] ?? '');
$description = trim($data['description'] ?? '');
$priority = trim($data['priority'] ?? 'Low');

if ($title === '' || $description === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Title and description are required"
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO tickets (title, description, priority, status) VALUES (?, ?, ?, ?)"
    );

    $stmt->execute([$title, $description, $priority, 'Open']);

    echo json_encode([
        "status" => "success",
        "message" => "Ticket created successfully"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

?>