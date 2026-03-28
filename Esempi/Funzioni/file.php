<?php

echo(getcwd());
echo "<br>" . DIRECTORY_SEPARATOR;
$path = getcwd();
echo is_file($path . DIRECTORY_SEPARATOR . "index.php") ? "true" : "false";
echo is_dir($path . DIRECTORY_SEPARATOR . "index.php") ? "true" : "false";

$item = scandir($path . DIRECTORY_SEPARATOR . "prova2");
echo "<h1> file della mia directory </h1>";
echo "<ul>";
foreach ($item as $items) {
    echo "<li>" . $items . "</li>";
}
echo "</ul>";

$file2 = fopen("testo.txt", "w");
//fwrite("targamarcello","testo.txt");
fclose($file2);

$classe = [
    "studente1" => ["nome1", "cognome1", 2],
    "studente2" => ["nome2", "cognome2", 5],
    "studente3" => ["nome3", "cognome3", 7],
    "studente4" => ["nome4", "cognome4", 2.5],
    "studente5" => ["nome5", "cognome5", 4],
    "studente6" => ["nome6", "cognome6", 1.25]
];
$file2 = fopen("voti.txt", "w");
foreach ($classe as $key => $stud) {
    $line = $key . ' (=^‿^=) ' . implode('--', $stud) . PHP_EOL;//rende ogni elemento dell'array una stringa perchè la fwrite vuole una stringa
    fwrite($file2, $line);
}
fclose($file2);
//di solito si usa la fwrite per fare file grandi, nel file piccoli si usa il file_put_contents()

$datiDaFile = [];
$file2 = fopen("voti.txt", "r");
while (($line = fgets($file2)) !== false) {
    $datiDaFile[] = trim($line);
}
fclose($file2);
foreach ($datiDaFile as $data) {
    echo $data . '<br>';
}
echo "<br><br>";

//EXPLODE
$frase = "oggi è una bella giornata";
$arrayFrase = explode(' ',$frase);
foreach ($arrayFrase as $parola){
    echo $parola.'<br>';
}
$stud = explode(',',$datiDaFile[1]);
foreach ($stud as $studente){
    echo $studente.'<br>';
}

function somma($a,$b){
    return $a+$b;
}
echo somma(3,6);

// con questa impostazione l'operatore conosce il tipo di dato in ingresso e uscita(riuscendo anche a dare più tipi di dato ai parametri)
function somma2(int|float $a,int|float $b): int|float{
    return $a+$b;
}
echo somma2(51,46.3);

function stampa(int|string $var): void{
    echo 'Hai passato '.$var;
}
echo '<br>';
stampa(2356);

function saluta(?string $nome): string{ //accetta o null o stringa
    return 'Ciao '.($nome ?? 'Ospite');
}
echo '<br>';
echo saluta('Mario');
echo '<br>';
echo saluta(null);

$myvar = 10;
function myFunction(&$myvar){
    $myvar = $myvar+1;
    echo $myvar;
}
echo '<br>';
myFunction($myvar);
echo '<br>';
echo $myvar;

function sommaTotale(...$numeri): int|float{
    return array_sum($numeri);
}
echo '<br>';
echo sommaTotale(1,4,25,5,2,5,52,6,1,7,38);