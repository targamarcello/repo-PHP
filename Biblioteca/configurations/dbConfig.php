<?php
//bisogna tenere un file di config staccato per la sicurezza
return [
    'dsn' => 'mysql:host=localhost;dbname=marcello_targa_itis;charset=utf8mb4',
    'username' => 'root',
    'password' => "",
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,//tratta le tuple come oggetti
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION//gestione degli errori sql come exception
    ]
];
