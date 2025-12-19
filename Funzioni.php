<?php

/*funzione di callback
 * passata per argomento
 * chiamata da un'altra funzione che può essere utilizzata in 2 momenti
 * quando si verifica un evento
 * Sono utili perchè possono eseguire funzioni intere quando si vuole
 * */

//Esempio:
function esegui($nomeFunz)
{
    $nomeFunz();
}

function saluta()
{
    echo "Ciao bellissimo";
}

esegui('saluta');

function applica($callback, $par)
{ //aggiunta di un parametro
    return $callback($par);
}

function doppio($val)
{
    return $val * 2;
}

echo '<br>';
echo applica('doppio', 5);
echo '<br>';

//Callback con funzione anonima
echo applica(function ($x) {
    return $x + 2;
}, 10);

/*
 * i 2 modi utilizzati si differenziano nel loro uso
 * quando la prima si usa se la funzione di callback so già che la userò di nuovo nel programma;
 *
 * mentre la seconda funzione si usa quasi sempre perchè è più diretta e veloce da usare
 * visto che si eseguono delle funzioni momentanee e senza manco il nome (anonima)
 * */

//Arrow Function - Funzioni anonime composte
echo '<br>';
echo applica(fn($n) => $n + 3, 4347);// la lambda vale SOLO con 1 espressione (operazione)

//OOP
class Studente
{
    private string $nome;
    private int $eta;
    private static int $numero = 1;

    public function __construct(string $nome, int $eta)
    {
        $this->nome = $nome;
        $this->eta = $eta;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getEta(): int
    {
        return $this->eta;
    }

    public function setEta(int $eta): void
    {
        $this->eta = $eta;
    }

    public function presentazione(): void
    {
        echo "<br>Ciao mi chiamo $this->nome e ho $this->eta anni.";
    }

    public static function stringa(): void
    {
        echo '<br> Sono uno studente <br>';
        //self si riferisce alla classe dentro qualcosa di statico
        echo self::$numero++;
    }
    //non confondere self con $this

}

$stud = new Studente('Franco', 35);
$stud->presentazione();
Studente::stringa();
Studente::stringa();
Studente::stringa();
Studente::stringa();
Studente::stringa();
Studente::stringa();
Studente::stringa();
Studente::stringa();