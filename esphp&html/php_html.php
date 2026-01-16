<?php
//Questo è server side
//questa zona al browser non arriva proprio, non sa manco cosa sia
$var = "Ciao a tutti";
$materie = ['Tpsit','Informatica','Sistemi','GPOI'];
$msg = 'Questo è un messaggio dal server per JS';
//array associativo con dentro 3 quadre separate da virgole,
// dentro ognuna ci si mette nome, cognome,media
$studentiAssociativi = [
    [
        "nome"=>"Carlo",
        "cognome"=>"Cracco",
        "media"=>8
    ],
    [
        "nome"=>"Mohamed",
        "cognome"=>"Guezam",
        "media"=>2.5
    ],
    [
        "nome"=>"Giulio",
        "cognome"=>"Gialli",
        "media"=>6
    ],
    [
        "nome"=>"Giuseppe",
        "cognome"=>"Barbagianni",
        "media"=>4.75
    ]
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <p>CIAO</p>
    <p><?php echo $var?></p>
    <!-- forma compatta per stampare una variabile-->
    <!-- il $var il browser non lo vede, ma riceve direttamente il contenuto della variabile-->
    <p><?=$var?></p>
    <!--uso un foreach per stampare tutti i componenti dell'array-->
    <?php foreach ($materie as $item):?>
    <hr>
    <p><?=$item?></p>
    <?php endforeach;?>

    <p><?php if (isset($materie[0])):?></p>
    <h1><?=$materie[1]?></h1>
    <p><?php else:?></p>
    <h1><?=$materie[2]?></h1>
    <?php endif;?>
    <button id="myBtn">Premi</button>
    <!-- questo passaggio diretto non si può fare
    <script> const message=<?=$msg?></script>-->
    <script> message = <?=json_encode($msg)?></script> <!-- funzione di php che permette la trasmissione della variabile-->

    <table>
        <tr>
            <?php foreach (array_keys($studentiAssociativi[0])as $key):?>
                <th><?=$key?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($studentiAssociativi as $items): ?>
            <tr>
                <!--Giusto ma non compatto -->
                <!-- <td><?= $items['nome']?></td>
                <td><?= $items['cognome']?></td>
                <td><?= $items['media']?></td> -->
                <!--Giusto e compatto -->
                <?php foreach ($items as $studente): ?>
                    <td><?= $studente?></td>
                <?php endforeach;?>
            </tr>
        <?php endforeach;?>
    </table>


    <script src="script.js"></script>
</body>
</html>
