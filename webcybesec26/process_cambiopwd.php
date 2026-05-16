
<?php
$title = "Process CambioPwd";
require  "header.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $content='Invalid request';
    require 'content.php';
    exit();
}

$pdo = new PDO(
    "mysql:host=192.168.60.144;dbname=marcello_targa_cyber;charset=utf8mb4",
    "marcello_targa",
    "contato.raffermi."
);
$pdo->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

// Utente loggato
$userId = $_SESSION['userId'];

// Dati form
$currentPassword = $_POST['current_password'] ?? '';
$newPassword     = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';


// Controllo conferma password
if ($newPassword !== $confirmPassword) {
    $content='Le password non coincidono';
    require 'content.php';
    exit();
}


// Validazione minima
if (strlen($newPassword) < 8) {
    $content='La nuova password deve avere almeno 8 caratteri';
    require 'content.php';
    exit();
}


// Recupero password hash dal database
$stmt = $pdo->prepare("
    SELECT pwd
    FROM Users
    WHERE userId = :id
");

$stmt->bindValue(':id', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

// Utente inesistente
if (!$user) {
    $content='Utente non trovato';
    require 'content.php';
    exit();
}

// Nuovo hash
$newHash = password_hash($newPassword, PASSWORD_DEFAULT);

// Update password
$update = $pdo->prepare("
    UPDATE Users
    SET pwd = :password
    WHERE userId = :id
");
$update->bindValue(':password', $newHash);
$update->bindValue(':id', $userId, PDO::PARAM_INT);
$update->execute();
$content= "Password aggiornata correttamente";
require 'content.php';