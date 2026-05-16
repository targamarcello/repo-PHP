<?php
$title = "Logout";
require  "header.php";
$_SESSION[]='';
session_destroy();
header('Location:content.php?content=logout effettuato');
