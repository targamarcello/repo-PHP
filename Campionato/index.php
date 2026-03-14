<?php
require './configurations/dbConf.php';
$config = require'configurations/dbConfig.php';
$db = dbConf::getDB($config);

$nCampionati = $db->query("SELECT count(*) FROM campionati")->fetchColumn();
$nPiloti = $db->query("SELECT count(*) FROM piloti")->fetchColumn();
$nGare = $db->query("SELECT count(*) FROM gare")->fetchColumn();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>Campionato 🚗</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="iscrizioni.php">Iscrizioni</a>
    <a href="risultati.php">Risultati</a>
    <a href="classifiche.php">Classifiche</a>
</nav>
<h1>CAMPIONATO AUT0MOBILISTICO</h1>

<div class="stats">
    <div class="stat"><div class="num"><?=$nCampionati?></div> <div class="lbl">Campionati</div></div>
    <div class="stat"><div class="num"><?=$nPiloti?></div> <div class="lbl">Piloti</div></div>
    <div class="stat"><div class="num"><?=$nGare?></div> <div class="lbl">Gare</div></div>
</div>

</body>
</html>