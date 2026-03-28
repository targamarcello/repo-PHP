<?php
$nome = $_POST ['nome'] ?? ""; //sto $_POST è una variabile superglobal, contiene i dati che abbiamo inserito nel form, SE abbiamo usato il metodo POST
$cognome = $_POST ['cognome'] ?? "";
$mail = $_POST ['email'] ?? "";
$password = $_POST ['password'] ?? "";
$eta = $_POST ['età'] ?? "";
$sesso = $_POST ['sesso'] ?? "";
$corsi = $_POST ['corsi'] ?? [];
$citta = $_POST ['città'] ?? "";
$lingua = $_POST ['lingua'] ?? [];
$area = $_POST ['area'] ?? "";
//operatore coalescing, differisce dal ternario perchè uno usa ?? e l'altro ?

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elabora</title>
</head>
<body>
<p>Nome: <?= $nome ?></p>
<p>Cognome: <?= $cognome ?></p>
<p>Mail: <?= $mail ?></p>
<p>Password: <?= $password ?></p>
<p>Età: <?= $eta ?></p>
<p>Sesso: <?= $sesso ?></p>
<p>Corsi: <?= implode(",", $corsi) ?></p>
<p>Lingua:
    <?php foreach ($lingua as $items) { ?>
        <?= $items ?>
    <?php } ?>
</p>
<p>Area: <?= $area ?></p>
</body>
</html>