<?php
$title = "CambioPwd";
require  "header.php";
?>
<form action="process_cambiopwd.php" method="POST">
    <br><br>
    <label>Nuova password</label>
    <br>
    <input type="password" name="new_password" required>
    <br><br>
    <label>Conferma nuova password</label>
    <br>
    <input type="password" name="confirm_password" required>
    <br><br>
    <button type="submit">Cambia password</button>
</form>
<?php require "footer.php"?>
