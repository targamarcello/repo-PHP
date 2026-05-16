<?php
$title="messaggi";
include ("header.php");
try {
    $pdo = new PDO(
        "mysql:host=192.168.60.144;dbname=marcello_targa_cyber;charset=utf8mb4",
        "marcello_targa",
        "contato.raffermi."
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $content='Errore interno';
    require 'content.php';
    exit();
}
$sql = "SELECT Comments.comment_id,Comments.comment_name,Comments.comment_message,Users.username
        FROM Comments
        INNER JOIN Users
        ON Comments.userId = Users.userId
        ORDER BY Comments.comment_id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$comments = $stmt->fetchAll();
foreach ($comments as $comment) {
    echo "<h3>" . htmlspecialchars($comment->comment_name) . "</h3>";
    echo "<p>";
    echo $comment->comment_message;
    //echo nl2br(htmlspecialchars($comment->comment_message));
    echo "</p>";
    echo "<small>";
    echo "Scritto da: " . htmlspecialchars($comment->username);
    echo "</small>";
    echo "<hr>";
}
include ("footer.php");
