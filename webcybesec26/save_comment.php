<?php
include "header.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $content='Errore interno';
    require 'content.php';
    exit();
}
$commentName = trim($_POST['comment_name'] ?? '');
$commentMessage = trim($_POST['comment_message'] ?? '');
if (empty($commentName) || empty($commentMessage)) {
    $content='Inserire tutti i valori richiesti';
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
$sql = "INSERT INTO Comments(comment_name,comment_message,userId) VALUES(:comment_name,:comment_message,:userId)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':comment_name', $commentName, PDO::PARAM_STR);
$stmt->bindValue(':comment_message', $commentMessage, PDO::PARAM_STR);
$stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
$success = $stmt->execute();
if (!$success) {
    $content='Errore di inserimento';
    require "content.php";
    exit();
}
$content= "Commento inserito!";
require "content.php";