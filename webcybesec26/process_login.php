<?php
$title = "Process Login";
require  "header.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $content='Invalid request';
    require 'content.php';
    exit();
}
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $content='All fields are required';
    require 'content.php';
    exit();
}

$pdo = new PDO(
    "mysql:host=192.168.60.144;dbname=marcello_targa_cyber;charset=utf8mb4",
    "marcello_targa",
    "contato.raffermi."
);
$pdo->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::FETCH_OBJ);

$sql = "SELECT userId, username, pwd 
        FROM Users
        WHERE username = :username";
try{
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch();
    if (!$user) {
        $content='Invalid username or password';
        require 'content.php';
        exit();
    }

} catch (PDOException $e) {
   error_log("generic login problem",$e->getMessage());
}

if (!password_verify($password, $user['pwd'])) {
    $content='Invalid username or password';
    require 'content.php';
    exit();
}
session_regenerate_id(true);
$_SESSION['userId'] = $user['userId'];
$_SESSION['username'] = $user['username'];
header('Location: index.php');