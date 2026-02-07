<?php
require './dbConn.php';
//PDO è una classe che permette la comunicazione con i database, semplicemente cambiando la configurazione dell'oggetto
$config = require './configurations/dbConfig.php';
$db = dbConn::getDB($config);
//il passaggio di chiavi allo script base è importante per la segretezza delle info

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

/*$queryI = 'insert into studenti(nome,cognome,media,data_iscrizione)
values (:nome,:cognome,:media,NOW())';
$select = 'select * from studenti';
try {
    $stmt = $pdo->prepare($queryI);
    $stmt->bindValue(':nome', 'Paolo');
    $stmt->bindValue(':cognome', 'Neri');
    $stmt->bindValue(':media', 9, PDO::PARAM_INT);
    $stmt->execute();
    echo "Insert successful";

    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}*/

//UPDATE
/*$queryU = 'UPDATE studenti
          set media = :media
          where nome = :nome';
try{
    $stmt = $pdo->prepare($queryU);
    $stmt->bindValue(':nome', 'Antonio');
    $stmt->bindValue(':media', 5, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt ->rowCount() === 0){
        echo "No rows were updated";
    }else{
        echo "Update successful";
    }
    $stmt->closeCursor();
}catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}*/

//DELETE
/*$queryD = 'DELETE from studenti where nome = :nome';
try{
    $stmt = $pdo->prepare($queryD);
    $stmt->bindValue('nome','Paolo');
    $stmt->execute();

    if($stmt->rowCount()===0){
        echo "No rows were updated";
    }else{
        echo "Update successful";
    }
}catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}*/
echo '<br>';


$queryR = 'select * from studenti';

try {
    $stmt = $db->prepare($queryR);
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        echo "nome: " . $user->nome . "<br>";
        echo "cognome: " . $user->cognome . "<br>";
        echo "media: " . $user->media . "<br>";
        echo "data iscrizione: " . $user->data_iscrizione . "<br>";
        echo '<hr>';
    }
    $stmt->closeCursor(); //importante chiudere così la memoria viene liberata e si possono fare altre query
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}