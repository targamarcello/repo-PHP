<?php
require './configurations/dbConf.php';
$config = require'configurations/dbConfig.php';
$db = dbConf::getDB($config);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>FastRoute - Home</title>
</head>
<body>
<div class="headr">
    <h1>FastRoute - Corriere Espresso</h1>
</div>
<div class="nav">
    <a href="index.php">Home</a>
    <a href="login.php">Area Personale</a>
</div>
<div class="container">
    <div class="card">
        <h2>Benvenuti da FastRoute</h2>
        <p>Il corriere espresso di fiducia</p>
        <p>Servizio più rapido e sicuro di tutta Italia</p>
        <p>Tracciamento spedizioni in tempo reale</p>
        <p>Programma con punti fedeltà per tutti i clienti</p>
    </div>
</div>

</body>
</html>