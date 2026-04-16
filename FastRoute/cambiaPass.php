<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);
session_start();
require'functions/extra.php';
requireLogin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new != $confirm) {
        $error = "Le password non coincidono";
    } elseif (strlen($new) < 8) {
        $error = "La password deve avere almeno 8 caratteri";
    } else {
        // Prendo l'hash dal database
        $stmt = $db->prepare("SELECT password FROM dipendenti WHERE cf = ?");
        $stmt->execute([$_SESSION['user_cf']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifico la password attuale
        if (password_verify($old, $user['password'])) {
            // Genero l'hash della nuova password
            $new_hash = password_hash($new, PASSWORD_DEFAULT);

            // Salvo l'hash nel database
            $stmt = $db->prepare("UPDATE dipendenti SET password = ?, password_modificata = 1 WHERE cf = ?");
            if ($stmt->execute([$new_hash, $_SESSION['user_cf']])) {
                $success = true;
            }
        } else {
            $error = "Password attuale errata";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modifica Password</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
<div class="login-box">
    <h2>Modifica Password</h2>
    <?php if($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="success">Password modificata! <a href="dashboard.php">Vai alla dashboard</a></div>
    <?php else: ?>
        <form method="POST">
            <div class="form-group">
                <label>Password attuale:</label>
                <input type="password" name="old_password" required>
            </div>
            <div class="form-group">
                <label>Nuova password (min 8 caratteri):</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Conferma nuova password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit">Modifica</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>