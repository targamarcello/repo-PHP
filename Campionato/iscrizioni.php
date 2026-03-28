<?php
require './configurations/dbConf.php';
$config = require'configurations/dbConfig.php';
$db = dbConf::getDB($config);
if(isset($_POST['add_campionato'])){
    $nome = trim($_POST['nome_camp']);
    try{
        $db->prepare('insert into campionati(nome) values(?)')->execute([$nome]);
        $msg = 'Campionato aggiunto';
    }catch(PDOException $e){
        $msg="Campionato già esistente";
    }
}

if(isset($_POST['add_casa'])) {
  $nome = trim($_POST['nome_casa']);
  $colore = trim($_POST['colore_livrea']);
  try{
      $db->prepare('insert into caseAutomobilistiche(nome,livrea) values(?,?)')->execute([$nome,$colore]);
      $msg = 'Casa aggiunta';
  }catch (PDOException $e){
      $msg = 'Casa già esistente';
  }
}

if (isset($_POST['add_pilota'])) {
    $cf = strtoupper(trim($_POST['cf']));
    $nome = trim($_POST['nomeP']);
    $cognome = trim($_POST['cognomeP']);
    $nazi = trim($_POST['nazionalita']);
    $num = trim($_POST['numero']);
    $casa = trim($_POST['casaP']);
    try{
        $db->prepare('insert into piloti (cf,nome,cognome,nazionalità,numero,nomeCasa) values(?,?,?,?,?,?)')->execute([$cf,$nome,$cognome,$nazi,$num,$casa]);
        $msg = 'Pilota aggiunto';
    }catch (PDOException $e){
        $msg = 'CF già esistente / casa non trovata';
    }
}

if(isset($_POST['add_gara'])){
    $data = trim($_POST['data_gara']);
    $camp = trim($_POST['camp_gara']);
    try{
        $db->prepare('insert into gare(data,nomeCampionato) values(?,?)')->execute([$data,$camp]);
        $msg = 'Gara aggiunta';
    }catch (PDOException $e){
        $msg='Gara già presente / campionato non trovato';
    }
}

$campionati = $db->query('select nome from campionati order by nome')->fetchAll(PDO::FETCH_ASSOC);
$case = $db->query('select nome,livrea from caseAutomobilistiche order by nome')->fetchAll(PDO::FETCH_ASSOC);
$piloti = $db->query('select * from piloti order by nome')->fetchAll(PDO::FETCH_ASSOC);
$gare = $db->query('select data,nomeCampionato from gare order by data desc')->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<h1>Iscrizioni</h1>

<div class="grid-2">
    <div class="card">
        <h2>Nuovo Campionato</h2>
        <form method="post">
            <label>Nome</label>
            <input type="text" name="nome_camp" required>
            <button name="add_campionato">Aggiungi</button>
        </form>
        <div>
            <?php foreach ($campionati as $c):?>
                <div class="list-row"> <?=htmlspecialchars( $c['nome'])?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card">
        <h2>Casa Automobilistica</h2>
        <form method="post">
            <label>Nome</label>
            <input type="text" name="nome_casa" required>
            <label>Colore livrea</label>
            <input type="text" name="colore_livrea" required>
            <button name="add_casa">Aggiungi</button>
        </form>
        <?php foreach ($case as $c):?>
            <div class="list-row">
                <span><?=htmlspecialchars($c['nome'])?></span>
                <span><?= htmlspecialchars($c['livrea'])?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="card">
        <h2>Pilota</h2>
        <form method="post">
            <label>Codice Fiscale</label>
            <input type="text" name="cf" required>
            <label>Numero Gara</label>
            <input type="number" name="numero">
            <label>Nome</label>
            <input type="text" name="nomeP" required>
            <label>Cognome</label>
            <input type="text" name="cognomeP" required>
            <label>Nazionalità</label>
            <input type="text" name="nazionalita">
            <label>Partecipazione</label>
            <select name="casaP" required>
                <option value="">SELEZIONA</option>
                <?php foreach ($case as $c): ?>
                    <option value="<?=htmlspecialchars($c['nome'])?>"><?=htmlspecialchars($c['nome'])?></option>
                <?php endforeach; ?>
            </select>
            <button name="add_pilota">Iscrivi</button>
        </form>
    </div>
    <div>
        <h2>Aggiungi Gara</h2>
        <form method="post">
            <label>Data</label>
            <input type="date" name="data_gara" required>
            <label>Campionato</label>
            <select name="camp_gara" required>
                <option value="">SELEZIONA</option>
                <?php foreach ($campionati as $c): ?>
                    <option value="<?=htmlspecialchars($c['nome'])?>"><?=htmlspecialchars($c['nome'])?></option>
                <?php endforeach; ?>
            </select>
            <button name="add_gara">Aggiungi</button>
        </form>
        <?php foreach ($gare as $g):?>
            <div class="list-row">
                <span><?=$g['data']?></span>
                <span><?= htmlspecialchars($g['nomeCampionato'])?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="card">
    <h2>Piloti Iscritti - <?=count($piloti)?></h2>
    <table>
        <thead>
            <tr><th>#</th><th>CF</th><th>Pilota</th><th>Nazionalità</th><th>Casa</th></tr>
        </thead>
        <tbody>
            <?php foreach ($piloti as $p):?>
                <tr>
                    <td class="pos-1"><?=$p['numero']?></td>
                    <td><?=htmlspecialchars($p['CF'])?></td>
                    <td><?=htmlspecialchars($p['nome'])?></td>
                    <td><?=htmlspecialchars($p['nazionalità'])?></td>
                    <td><?=htmlspecialchars($p['nomeCasa'])?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>