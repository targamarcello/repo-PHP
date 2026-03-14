<?php
$tmp_path = $_FILES["documento"]["tmp_name"];

echo $tmp_path;

$originalName = basename($_FILES['documento']['name']);
$destination = 'uploads/'.$originalName;
move_uploaded_file($tmp_path,$destination);