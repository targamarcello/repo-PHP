<?php
$title = "Cerca";
require  "header.php";
?>
<!-- search_form.html -->
<form action="process_cerc.php" method="GET">
    <br><br>
    <label>Ricerca:</label><br>
  <input type="text" name="q" placeholder="Search...">
  <button type="submit">Search</button>
</form>
<?php require "footer.php"?>
