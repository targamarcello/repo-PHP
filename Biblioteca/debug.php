<?php
require './configurations/dbConf.php';
$config = require'configurations/dbConfig.php';
$db = dbConf::getDB($config);

$queryS = 'select * from utenti order by numero_tessera asc';
$ris = $db->query($queryS);
$utenti = [];

if($ris){
    while($row = $ris->fetch(PDO::FETCH_ASSOC)){
        $utenti[] = $row;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <span class="debugBadge">Modalità debug</span>
        <h1>Utenti Registrati</h1>
        <p class="sottotitolo">Visualizzazione completa</p>
    </div>
    <?php if (count($utenti) > 0): ?>
    <div class="stats">
        <div class="card">
            <div class="numero"><?= count($utenti);?></div>
            <div class="label">Utenti Totali</div>
        </div>
        <div class="card">
            <div class="numero">#<?= str_pad($utenti[count($utenti)-1]['numero_tessera'],4,'0',STR_PAD_LEFT)?></div>
            <div class="label">Ultima tessera</div>
        </div>
    </div>
    <table>
        <tr>
            <th>N° Tessera</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data Iscrizione</th>
        </tr>
        <tbody>
            <?php foreach ($utenti as $utente): ?>
                <tr>
                    <td>
                        <span class="tessera">
                            #<?= str_pad($utente['numero_tessera'],4,'0',STR_PAD_LEFT);?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($utente['nome']);?></td>
                    <td><?= htmlspecialchars($utente['cognome']);?></td>
                    <td><?= date('d/m/y',strtotime($utente['data_iscrizione']));?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="no-data">
            <p>Nessun utente registrato</p>
            <a href="registrazione.php" class="btn">Registra il primo utente</a>
        </div>
    <?php endif; ?>
    <a href="index.php" class="back">Torna alla home</a>
</div>

<script src="./public/javascript/debug.js"></script>
</body>
</html>