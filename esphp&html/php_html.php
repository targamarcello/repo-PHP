<?php
// Questo è server side
// Questa zona al browser non arriva proprio, non sa manco cosa sia
$var = "Ciao a tutti";
$materie = ['Tpsit', 'Informatica', 'Sistemi', 'GPOI'];
$msg = 'Questo è un messaggio dal server per JS';
// array che contiene 3 array associativi con quadre separate da virgole
$studentiAssociativi = [
    [
        "nome" => "Carlo",
        "cognome" => "Cracco",
        "media" => 8
    ],
    [
        "nome" => "Mohamed",
        "cognome" => "Guezam",
        "media" => 2.5
    ],
    [
        "nome" => "Giulio",
        "cognome" => "Gialli",
        "media" => 6
    ],
    [
        "nome" => "Giuseppe",
        "cognome" => "Barbagianni",
        "media" => 4.75
    ]
];
$voti = [
        "Carlo" => 6.2,
        "Luigi" =>2.6,
        "Mario" => 7.2,
        "Maurizio" => 8.3
];
$i = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>document</title>
</head>
<body>
<p>CIAO</p>
<p><?php echo $var ?></p>
<!-- forma compatta per stampare una variabile-->
<!-- il $var il browser non lo vede, ma riceve direttamente il contenuto della variabile-->
<p><?= $var ?></p>
<!--uso un foreach per stampare tutti i componenti dell'array-->
<?php foreach ($materie as $item): ?>
    <hr>
    <p><?= $item ?></p>
<?php endforeach; ?>
<hr>

<?php if (isset($materie[0])): ?>
    <h1><?= $materie[1] ?></h1>
<?php else: ?>
    <h1><?= $materie[2] ?></h1>
<?php endif; ?>
<button id="myBtn">Premi</button>
<!-- questo passaggio diretto non si può fare
    <script> const message=<?= $msg ?></script>-->
<script> message = <?= json_encode($msg) ?></script>
<!-- funzione di php che permette la trasmissione della variabile convertendola in formato json-->

<table>
    <tr>
        <!--Prende dall'array le chiavi in posizione 0, cioè nome-cognome-media -->
        <?php foreach (array_keys($studentiAssociativi[0]) as $key): ?>
            <th><?= $key ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($studentiAssociativi as $items): ?>
        <tr>
            <!--Giusto ma non compatto -->
            <!-- <td><?= $items['nome'] ?></td>
                <td><?= $items['cognome'] ?></td>
                <td><?= $items['media'] ?></td> -->
            <!--Giusto e compatto -->
            <?php foreach ($items as $studente): ?>
                <td><?= $studente ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<!--Esempio col while -->
<?php $nomi = array_keys($voti) ?>
<h2>Medie degli studenti <?php while($i<count($nomi)):?></h2>
<li><?=$nomi[$i]?> : <?=$voti[$nomi[$i]] ?></li>
<?php $i++ ?>
<?php endwhile; ?>

<!--Esempio di footer con copyright-->
<footer>
    <p>&copy; <?= date("Y") ?> La mia scuola. Tutti i diritti riservati.</p>
    <p>Contatti: info@scuola.it</p></footer>

<script src="script.js"></script>
</body>
</html>