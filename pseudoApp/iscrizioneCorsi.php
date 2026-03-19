<?php
$nCorsi = $_POST['numeroCorsi'] ?? 0;
$json = 'professori.json';
//verifica l'esistenza del file json
if(file_exists($json)){
    $professori = json_decode(file_get_contents($json),true) ?? []; //decodifica il contenuto se ha qualcosa
}else{
    $professori = [];
}
if (isset($_POST['nome'], $_POST['cognome'])) {
    $newProf = "Prof".(count($professori) + 1);
    $professori[$newProf] = [
            'nome' => trim($_POST['nome']),
            'cognome' => trim($_POST['cognome'])
    ];
    file_put_contents($json, json_encode($professori));
}
$corsi = ["sistemi e reti", "info", "statistica", "contabilità", "marketing", "tecnologie", "meccatronica", "elettronica", "chimica organica", "robotica"];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Adesione Corsi</title>
</head>
<body>

<form method="post">
    <input type="hidden" name="numeroCorsi" value="<?= $nCorsi ?>">
    <h2>Nuovo Professore</h2>
    <div class="campo">
        <label>Nome:</label> <br>
        <input type="text" name="nome" required>
    </div>
    <div class="campo">
        <label>Cognome:</label> <br>
        <input type="text" name="cognome" required>
    </div>
    <button type="submit">Aggiungi</button>
</form>

<form method="post" action="tabellaCorsi.php">
    <?php for ($i = 0; $i <= $nCorsi-1; $i++): ?>
        <div class="box">
            <h3>Corso <?= $i+1?></h3>
            <div class="campo">
                <label>Professore:</label><br>
                <label>
                    <select name="professore[<?= $i ?>]">
                        <?php foreach ($professori as $prof => $key): ?>
                            <option value="<?= $key['nome'] . ';' . $key['cognome'] ?>">
                                <?= $key['nome'] . " - " . $key['cognome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="campo">
                <label>Corsi:</label><br>
                <select name="corsi[<?= $i ?>][]">
                    <?php foreach ($corsi as $corso): ?>
                        <option value="<?= $corso ?>">
                            <?= ucfirst($corso) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
    <?php endfor; ?>
    <button type="submit">Invia</button>
</form>

<a href="index.php">Home</a>
</body>
</html>
