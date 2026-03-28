<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Attivazione Corsi</title>
</head>
<body>
<form method="post" action="iscrizioneCorsi.php">
    <label for="numeroCorsi">Corsi da attivare (1-10)</label>
    <input type="number" id="numeroCorsi" name="numeroCorsi" min="1" max="10">
    <button type="submit">Invia</button>
</form>
</body>
</html>
