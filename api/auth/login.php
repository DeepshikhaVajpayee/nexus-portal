<?php

header("Content-Type: application/json");

require_once "../../config/database.php";
require_once "../../config/jwt.php";

$data = json_decode(file_get_contents("php://input"), true);

if(!$data){
    echo json_encode([
        "status" => "error",
        "message" => "No input received"
    ]);
    exit;
}

$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user && password_verify($password, $user['password'])){

    $token = generateToken($user);

    echo json_encode([
        "status" => "success",
        "message" => "Login successful",
        "token" => $token,
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "role" => $user['role']
        ]
    ]);

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}

?>