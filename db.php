<?php
$host = getenv('MYSQLHOST')     ?: 'localhost';
$port = getenv('MYSQLPORT')     ?: '3306';
$db   = getenv('MYSQLDATABASE') ?: 'railway';
$user = getenv('MYSQLUSER')     ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';

$conn = new mysqli($host, $user, $pass, $db, (int)$port);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["ok" => false, "msg" => $conn->connect_error]));
}

$conn->set_charset("utf8mb4");
