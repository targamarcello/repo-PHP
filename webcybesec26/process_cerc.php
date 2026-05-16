<?php
$title = "Cerca";
require 'header.php';
$search_query = $_GET['q'];
echo "<h1>Ricerca in corso.... " . htmlspecialchars($search_query) . "</h1>";
//echo "<h1>Ricerca in corso.... " . $search_query . "</h1>";
require 'footer.php';
