<?php
$title = "Registrazione";
require  "header.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $content='Richiesta non valida';
    exit;
}
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['pwd'] ?? '';
if (empty($username) || empty($email) || empty($password)) {
    $content='Inserire tutti i campi';
    require 'content.php';
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $content='Email non valida';
    require 'content.php';
    exit;
}

if (strlen($password) < 6) {
    $content='La password deve contenere almeno 6 caratteri';
    require 'content.php';
    exit();
}
try {
    $pdo = new PDO(
        "mysql:host=192.168.60.144;dbname=marcello_targa_cyber;charset=utf8mb4",
        "marcello_targa",
        "contato.raffermi."
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $content='Errore interno';
    require 'content.php';
    exit();
}
$sql = "SELECT * FROM Users WHERE username = :username OR email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();
if ($user) {
    $content='Username or email già presente';
    require 'content.php';
    exit();
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO Users(username, email, pwd)
        VALUES(:username, :email, :pwd)";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pwd', $hashedPassword, PDO::PARAM_STR);
    $success = $stmt->execute();
    if (!$success) {
        $content='Registrazione non possibile';
        require 'content.php';
        exit();
    }
} catch (PDOException $e) {
    error_log("Registration failed: " . $e->getMessage());
}
$content= "Registrazione avvenuta con successo!";
require 'content.php';