<?php
require './configurations/dbConf.php';
$config = require'configurations/dbConfig.php';
$db = dbConf::getDB($config);
$msg='';
$tipo = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $password = trim($_POST['password']);
    $iscrizione = trim($_POST['data_iscrizione']);

    if (empty($nome) || empty($cognome) || empty($password) || empty($iscrizione)) {
        $msg = 'Bisogna completare tutti i campi';
        $tipo = 'errore';
    } else {
        //ottenimento numero tessera
        $queryS = "select max(numero_tessera) as max_tessera from utenti";
        $result = $db->query($queryS);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $max_tessera = $row['max_tessera'] + 1;
        //inserimento utente
        $queryI = 'insert into utenti(numero_tessera,nome,cognome,data_iscrizione,password) values(?,?,?,?,?)';
        $stmt = $db->prepare($queryI);
        if ($stmt->execute([$max_tessera, $nome, $cognome, $iscrizione, $password])) {
            $msg = 'Utente inserito correttamente';
            $tipo = 'successo';
        } else {
            $msg = 'Utente non inserito correttamente';
            $tipo = 'errore';
        }
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
    <h1>Registrazione Utente</h1>
    <p class="sottotitolo">Compila il form per registrare un nuovo utente</p>
    <?php if ($msg):?>
    <div class="messaggio <?= $tipo;?>">
        <?= $msg;?>
    </div>
    <?php endif;?>
    <form method="post">
        <div class="form-group">
            <label for="nome">Nome <span class="required">*</span></label>
            <input type="text" id="nome" name="nome" required ">
        </div>
        <div class="form-group">
            <label for="cognome">Cognome <span class="required">*</span></label>
            <input type="text" id="cognnome" name="cognome" required>
        </div>
        <div class="form-group">
            <label for="data_iscrizione">Data Iscrizione <span class="required">*</span></label>
            <input type="date" id="data_iscrizione" name="data_iscrizione" required>
        </div>
        <div class="form-group">
            <label for="password">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Registra</button>
            <button type="reset" class="btn-secondario">Reset</button>
        </div>
    </form>

    <a href="index.php" class="back">Torna alla home</a>
</div>

<script src="./public/javascript/registrazione.js"></script>
</body>
</html>
