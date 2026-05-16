<?php
$title='';
require_once "header.php";
?>
<h1><?php
    echo $content ?? ($_GET['content'] ?? '')?></h1>
<?php
require "footer.php";
?>

