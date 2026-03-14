<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $numero_tessera = trim($_POST['numero_tessera']);
    $data_iscrizione = trim($_POST['data_iscrizione']);
    $password = trim($_POST['password']);
}
echo $nome;
echo "<br>";
echo $cognome;
echo "<br>";
echo $numero_tessera;
echo "<br>";
echo $data_iscrizione;
echo "<br>";
echo $password;
