<?php

require_once "../../config/jwt.php";

$headers = getallheaders();

if(!isset($headers['Authorization'])){
    http_response_code(401);
    echo json_encode(["status"=>"error","message"=>"Token missing"]);
    exit;
}

$token = str_replace("Bearer ", "", $headers['Authorization']);

$user = verifyToken($token);

if(!$user){
    http_response_code(401);
    echo json_encode(["status"=>"error","message"=>"Invalid token"]);
    exit;
}