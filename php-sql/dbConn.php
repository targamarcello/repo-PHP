<?php

class dbConn
{
    private static ?PDO $db = null; //il ? serve per poter inizializzare la variabile a null

    public static function getDB(array $config): PDO
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    $config['dsn'],
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                //reimpostazione a null per evitare ci sia roba strana
                self::$db = null;
            }
        }
        //return serve perchè se non c'è una connessione è inutile gestire la variabile
        return self::$db;

    }
}