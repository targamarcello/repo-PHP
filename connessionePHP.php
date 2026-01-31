<?php
$pdo = new PDO(
//dsn = data source
    'mysql:host=192.168.60.144;dbname=marcello_targa_itis;charset=utf8mb4',
    'marcello_targa',
    'contato.raffermi.',
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,//tratta le tuple come oggetti
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//gestione degli errori sql come exception
    ]
);
//READ
/*$query = 'select * from studenti';

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        echo "nome: ".$user->nome."<br>";
        echo "cognome: ".$user->cognome."<br>";
        echo "media: ".$user->media."<br>";
        echo "data iscrizione: ".$user->data_iscrizione."<br>";
        echo '<hr>';
    }
    $stmt->closeCursor(); //importante chiudere così la memoria viene liberata e si possono fare altre query
}catch (PDOException $e){
    echo "A DB error occurred. Please try again later.";
}*/


//READ 2
/*$query = 'select * from studenti where nome = :name';
try {
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', 'Bernardo', PDO::PARAM_STR);//valorizzazione
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        echo "cognome: " . $user->cognome . "<br>";
        echo "media: " . $user->media . "<br>";
        echo "data iscrizione: " . $user->data_iscrizione . "<br>";
    }
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}*/
//READ 2
/*$query = 'select media,cognome from studenti where nome = :name';
try {
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', 'Bernardo', PDO::PARAM_STR);//valorizzazione
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        echo "cognome: " . $user->cognome . "<br>";
        echo "media: " . $user->media . "<br>";}
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}*/
$query = 'insert into studenti(nome,cognome,media,data_iscrizione)
values (:nome,:cognome,:media,NOW())';
$select = 'select * from studenti';
try {
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':nome', 'Paolo');
    $stmt->bindValue(':cognome', 'Neri');
    $stmt->bindValue(':media', 9, PDO::PARAM_INT);
    $stmt->execute();
    echo "Insert successful";

    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}