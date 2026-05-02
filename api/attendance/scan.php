<?php

header("Content-Type: application/json");

require_once "../../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$uid = $data['uid'] ?? '';

if(empty($uid)){

    echo json_encode([
        "status"=>"error",
        "message"=>"RFID UID missing"
    ]);

    exit;
}

$stmt = $pdo->prepare(
    "SELECT * FROM employees WHERE rfid_uid=?"
);

$stmt->execute([$uid]);

$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$employee){

    echo json_encode([
        "status"=>"error",
        "message"=>"Employee not found"
    ]);

    exit;
}

$employeeId = $employee['id'];

$check = $pdo->prepare(
    "SELECT * FROM attendance_logs
     WHERE employee_id=?
     ORDER BY id DESC LIMIT 1"
);

$check->execute([$employeeId]);

$lastLog = $check->fetch(PDO::FETCH_ASSOC);

$status = "Checked In";

if($lastLog){

    if($lastLog['status']=="Checked In"){
        $status = "Checked Out";
    }
}

$insert = $pdo->prepare(
    "INSERT INTO attendance_logs(employee_id,status)
     VALUES(?,?)"
);

$insert->execute([$employeeId,$status]);

echo json_encode([

    "status"=>"success",

    "employee"=>$employee['name'],

    "department"=>$employee['department'],

    "attendance_status"=>$status
]);
?>