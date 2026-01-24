<?php
/*prima pagina, quanti corsi vuoi attivare? sotto deve avere un input che va da 1-10, bulzante invio
seconda pagina, iscrizione corsi, devono comparire tanti rettangoli quanti corsi hai inserito;
deve avere un list box multipla con i professori e una list box singola con i corsi
terza pagina: iscrizione corsi, cognome - nome - corso (intestazione tabella), sotto andranno i valori di riferimento
il nome dei professori devono arrivare come un'array e i corsi su un altro array
corsi: sistemi e reti, info, statistica, contabilità, marketing, tecnologie, meccatronica, elettronica, chimica organica, robotica*/

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attivazione Corsi</title>
</head>
<body>
<form method="post" action="iscrizioneCorsi.php">
<label for="numeroCorsi">Corsi da attivare (1-10)</label>
<input type="number" id="numeroCorsi" name="numeroCorsi" min="1" max="10"><br>
<button type="submit">Invia</button>
</form>
</body>
</html>
