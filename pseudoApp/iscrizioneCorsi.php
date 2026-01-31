<?php
$nCorsi = $_POST['numeroCorsi'] ?? 0;
$professori = [
    "Prof1" => [
        "nome" => "Giovanni",
        "cognome" => "Padovani"
    ],
    "Prof2" => [
        "nome" => "Emiliano",
        "cognome" => "Spiller"
    ],
    "Prof3" => [
        "nome" => "Alessandro",
        "cognome" => "Mazzullo"
    ],
    "Prof4" => [
        "nome" => "Cristiano",
        "cognome" => "Gregnanin"
    ],
    "Prof5" => [
        "nome" => "Enrico Ermanno",
        "cognome" => "Dall'Ara"
    ],
    "Prof6" => [
        "nome" => "Arianna",
        "cognome" => "Franceschetti"
    ],
    "Prof7" => [
        "nome" => "Filippo",
        "cognome" => "Gasparini"
    ]
];
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
<form method="post" action="tabellaCorsi.php">
    <?php for ($i = 0; $i <= $nCorsi; $i++): ?>
        <div class="box">
            <h3>Corso <?= $i ?></h3>
            <div class="campo">
                <label>Professore:</label><br>
                <label>
                    <select name="professore[<?= $i ?>]">
                        <?php foreach ($professori as $prof => $key): ?>
                            <option value="<?= $prof ?>">
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
</body>
</html>
