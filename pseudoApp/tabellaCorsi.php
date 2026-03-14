<?php
$professori = $_POST["professori"]??[];
$corsi = $_POST["corsi"]??[];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Tabella Corsi</title>
</head>

<body>
<h2>Adesione Corsi</h2>
<table>
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Corso/i</th>
    </tr>

    <?php foreach ($professori as $prof => $key): ?>
        <?php
            list($nome, $cognome) = explode(";", $key);
            $listaCorsi = $corsi[array_search($corsi)[$key]] ?? [];
        ?>
        <tr>
            <td><?= $nome?></td>
            <td><?= $cognome?></td>
            <td><?= implode(',',$listaCorsi)?></td>
        </tr>
    <?php endforeach ?>
</table>
</body>
</html>
