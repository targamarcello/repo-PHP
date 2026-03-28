<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--l'attributo action serve per, dopo aver inviato i dati, salvarli in un file, che in questo esempio è 'elabora.php' -->
<form method="post" action="elabora.php">
    <h1>Informazioni</h1>
    <label for="nome">Nome: </label><input id="nome" type="text" name="nome"><br>
    <label for="cognome">Cognome: </label><input id="cognome" type="text" name="cognome"><br>
    <label for="mail">Mail: </label><input id="mail" type="email" name="email"><br>
    <label for="password">Password: </label><input id="password" type="password" name="password"><br>
    <label for="età">Età: </label><input id="età" type="number" name="età"><br><br>
    <label>Sesso</label><br>
    <label for="sessoM">M</label>
    <input id="sessoM" type="radio" name="sesso" value="M">
    <label for="sessoF">F</label>
    <input id="sessoF" type="radio" name="sesso" value="F">
    <br><br>
    <label>Corsi</label>
    <label for="corsoPHP">CorsoPHP</label>
    <input id="corsoPHP" type="checkbox" name="corsi[]" value="php"><br>
    <label for="corsoJAVA">CorsoJava</label>
    <input id="corsoJAVA" type="checkbox" name="corsi[]" value="java"><br>
    <label for="corsoHTML">CorsoHTML</label>
    <input id="corsoHTML" type="checkbox" name="corsi[]" value="html"><br><br>
    <label for="città">Città di residenza</label><br>
    <select name="città">
        <!--    LIST BOX SINGOLA-->
        <option value="">--Seleziona--</option>
        <option value="Roma">Roma</option>
        <option value="Milano">Milano</option>
        <option value="Firenze">Firenze</option>
        <option value="Napoli">Napoli</option>
        <option value="Palermo">Palermo</option>
        <option value="Rovigo">Rovigo</option>

    </select><br>
    <!--        LIST BOX MULTIPLA -->
    <label for="lingua[]">Lingue conosciute</label><br>
    <select name="lingua[]" id="lingua" multiple>
        <option value="Inglese">Inglese</option>
        <option value="Francese">Francese</option>
        <option value="Tedesco">Tedesco</option>
        <option value="Spagnolo">Spagnolo</option>
    </select><br>
    <label for="area">Parlaci di te</label><br>
    <textarea name="area" id="area" cols="30" rows="5"></textarea>

    <br>
    <button type="submit">Invia</button>
</form>
</body>
</html>
