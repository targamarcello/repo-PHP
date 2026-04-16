<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);
session_start();

if (isset($_SESSION['user_cf'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT d.cf, d.password, d.password_modificata, p.nome 
                          FROM dipendenti d 
                          JOIN persone p ON d.cf = p.cf 
                          WHERE p.email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // password_verify confronta la password in chiaro con l'hash nel DB
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_cf'] = $user['cf'];
        $_SESSION['user_name'] = $user['nome'];

        if (!$user['password_modificata']) {
            header('Location: cambiaPass.php');
        } else {
            header('Location: dashboard.php');
        }
        exit();
    } else {
        $error = "Email o password errati";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
<div class="login-box">
    <h2>Login FastRoute</h2>
    <?php if($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Accedi</button>
    </form>
    <p style="margin-top: 15px; text-align: center;">
        <a href="index.php">← Torna alla home</a>
    </p>
</div>
</body>
</html>