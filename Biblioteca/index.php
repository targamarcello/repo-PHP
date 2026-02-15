<?php
date_default_timezone_set('Europe/Rome'); //serve per impostare il fuso orario a ROMA
$dataOra = date("Y-m-d");
$giorni = array(
        'Lunedì' => 'Monday',
        'Martedì' => 'Tuesday',
        'Mercoleì' => 'Wednesday',
        'Giovedì' => 'Thursday',
        'Venerdì' => 'Friday',
        'Sabato' => 'Saturday',
        'Domenica' => 'Friday'
);

$mesi = array(
        'Gennaio' => 'January', 'Febbraio' => 'February',
        'Marzo' => 'March', 'Aprile' => 'April',
        'Maggio' => 'May', 'Giugno' => 'June',
        'Luglio' => 'July', 'Agosto' => 'August',
        'Settembre' => 'September', 'Ottobre' => 'October',
        'Novembre' => 'November', 'Dicembre' => 'Dicember'
);
$dataOraAdesso = strtr($dataOra, array_merge($giorni, $mesi));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>Biblioteca</title>
</head>
<body>
<div class="container">
    <h1>Biblioteca Comunale</h1>
    <p class="sottotitolo">Sistema di gestione utenti</p>
    <div class="datetime">
        <p> <?= $dataOraAdesso;?></p>
    </div>
    <a href="registrazione.php" class="btn">Registra un nuovo utente</a>
    <div class="debug">
        <a href="debug.php">Visualizza utenti</a>
    </div>
</div>
<script src="public/javascript/script.js"></script>
</body>
</html>
