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
<form method="POST" action="upload.php" enctype="multipart/form-data">
    <label for="nome">Nome:</label><br>
    <input type="text" name="nome"><br>

    <label for="cognome">Cognome:</label><br>
    <input type="text" name="cognome"><br>

    <label for="documento">File:</label><br>
    <input type="file" name="documento"><br><br>

    <input type="submit" value="Carica File">
</form>
</body>
</html>