<?php

$frutta = [
    "a" => "Mela",
    "b" => "Banana",
    "c" => "Ciliegia",
    "d" => "Uva"
];

//array_keys()
echo "----- ARRAY_KEYS() -----";
echo "<br>";
//mostra le chiavi dell'array
var_dump(array_keys($frutta));
echo "<br><br>";

//array_values()
echo "----- ARRAY_VALUES() -----";
echo "<br>";
//mostra i valori dell'array
var_dump(array_values($frutta));
echo "<br><br>";

//array_key_exists()
echo "----- ARRAY_KEY_EXISTS() -----";
echo "<br>";
//controlla se una chiave esiste nell'array
if (array_key_exists("d", $frutta)) {
    echo $frutta["d"];
}
echo "<br><br>";

//isset()
echo "----- ISSET() -----";
echo "<br>";
//controlla se la chiave non è null
if (isset($frutta["b"])) {
    echo $frutta["b"];
} else {
    echo "Frutto null";
}
echo "<br><br>";

//in_array()
echo "----- IN_ARRAY() -----";
echo "<br>";
//controlla se un valore esiste nell'array
if (in_array("c", $frutta)) {
    echo $frutta["c"];
} else {
    echo "Frutto non trovato";
}
echo "<br><br>";

//array_search()
echo "----- ARRAY_SEARCH() -----";
echo "<br>";
//cerca un valore nell'array e ritorna in quale chiave si trova
var_dump(array_search("Ciliegia", $frutta));
echo "<br><br>";

//unset()
echo "----- UNSET() -----";
echo "<br>";
//rimuove un elemento dalla chiave
unset($frutta["a"]);
var_dump($frutta);
echo "<br><br>";

//array_merge
echo "----- ARRAY_MERGE() -----";
echo "<br>";
$frutta2 = ["Arancia", "Limone"];
//unione di 2 array diversi
var_dump(array_merge(array_values($frutta), $frutta2));
echo "<br><br>";

//asort()
echo "----- ASORT() -----";
echo "<br>";
$ordina = $frutta;
//ordina i valori in maniera crescente
asort($ordina);
var_dump($ordina);
echo "<br><br>";

//arsort()
echo "----- ARSORT() -----";
echo "<br>";
//ordina i valori in maniera decrescente
arsort($ordina);
var_dump($ordina);
echo "<br><br>";

//ksort()
echo "----- KSORT() -----";
echo "<br>";
//ordina le chiavi in maniera crescente
ksort($ordina);
var_dump($ordina);
echo "<br><br>";

//krsort()
echo "----- KRSORT() -----";
echo "<br>";
//ordina le chiavi in maniera decrescente
krsort($ordina);
var_dump($ordina);
echo "<br><br>";

//array_map()
echo "----- ARRAY_MAP() -----";
echo "<br>";
$numeri = [1, 2, 3, 4, 5, 6, 7, 8, 9];
//applica una funzione di callback ad ogni elemento di un array
$risultato = array_map(function ($n) {
    return $n * 2;
}, $numeri);
var_dump($risultato);
echo "<br><br>";

//array_filter()
echo "----- ARRAY_FILTER() -----";
echo "<br>";
//filtra l'array cercando i numeri che soddisfano la condizione
$pari = array_filter($numeri, fn($n) => $n % 2 == 0);
var_dump($pari);
echo "<br><br>";

//array_walk()
echo "----- ARRAY_WALK() -----";
echo "<br>";
//applica una function ad ogni elemento e modifica direttamente l'array
array_walk($frutta, function ($valore, $chiave) {
    echo "$chiave => " . $valore . "<br>";
});
echo "<br><br>";

//array_slice()
echo "----- ARRAY_SLICE() -----";
echo "<br>";
//spezza l'array dall'indice 0 al 3
$slice = array_slice($frutta, 0, 3);
var_dump($slice);
echo "<br><br>";

//erray_splice()
echo "----- ARRAY_SPLICE() -----";
echo "<br>";
//modifica una parte dell'array (quello originale senza copiarlo)
$arr = $numeri;
array_splice($arr, 3, 3); //rimuove 3 elementi dall'indice 3
var_dump($arr);
echo "<br><br>";
