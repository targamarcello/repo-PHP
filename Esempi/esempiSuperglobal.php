<?php
require './Biblioteca/configurations/dbConfig.php';

/*if($_SERVER['REQUEST_METHOD']=== 'POST'){

}*/

/*echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['REMOTE_ADDR'];
echo "<br>";
echo $_SERVER['REQUEST_METHOD'];
*/
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
<form method="POST" action="esito.php">

    Nome: <br>
    <input type="text" name="nome"><br><br>

    Cognome: <br>
    <input type="text" name="cognome"><br><br>

    Numero Tessera: <br>
    <input type="number" name="numero_tessera" min="1" max="1000"><br><br>

    Data Iscrizione: <br>
    <input type="date" name="data_iscrizione"><br><br>

    Password: <br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Registra">

</form>

</body>
</html>
