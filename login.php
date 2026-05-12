<?php
header("Content-Type: application/json");
require "db.php";
$usuario = trim($_GET['usuario'] ?? '');
$password = trim($_GET['password'] ?? '');
<?php
$host = getenv('MYSQLHOST')
$port = getenv('MYSQLPORT')

?: 'localhost';
?: '3306';

$db
$user = getenv('MYSQLUSER')
= getenv('MYSQLDATABASE') ?: 'railway';
?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$conn = new mysqli($host, $user, $pass, $db, (int)$port);

if (!$usuario || !$password)
die(json_encode(["ok"=>false,"msg"=>"Faltan datos"]));
if ($conn->connect_error) {

} $conn-
>set_charset("utf8mb4");
http_response_code(500);
die(json_encode(["ok" => false, "msg" => $conn->connect_error]));

$stmt = $conn->prepare("SELECT password FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
echo ($row && password_verify($password, $row['password']))
? json_encode(["ok" => true])
: json_encode(["ok" => false, "msg" => "Credenciales incorrectas"]);
