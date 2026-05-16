<?php
session_start();
?>
<!-- login.php -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myStyle.css">
    <title><?= /** @var string $title */
        $title?> </title>
</head>
<body>
<a href="index.php">Home</a>
<?php if( !isset($_SESSION['username'])) { ?>
<a href="login.php">Login</a>
<?php } ?>
<a href="register.php">Register</a>
<?php if( isset($_SESSION['username'])) { ?>
    <a href="tuoMessaggio.php">Tuo Messaggio</a>
    <a href="messaggi.php">Bacheca Messaggi</a>
    <a href="cambiopwd.php">Cambio Pwd</a>
    <a href="logout.php">Logout</a>
<?php } ?>
<a href="search.php">Ricerca</a>


<span><?php echo $_SESSION['username'] ?? '' ?></span>

