<?php

function generateToken($user){
    $payload = [
        "id" => $user["id"],
        "email" => $user["email"],
        "role" => $user["role"],
        "time" => time()
    ];

    return base64_encode(json_encode($payload));
}

function verifyToken($token){
    $decoded = json_decode(base64_decode($token), true);

    if(!$decoded){
        return false;
    }

    return $decoded;
}

?>