<?php
echo "Hello, World!";
echo "<br><br>";

// Variabili
$var = 10;
$var2 = 2.5;
$arr = [3, 6, 42];

echo "Il valore della prima variabile è: " . $var . "<br>";
var_dump($var);
echo "<br><br>";

echo "Il valore della seconda variabile è: " . $var2 . "<br>";
var_dump($var2);
echo "<br><br>";

echo "Pi Greco: " . M_PI . "<br><br>";

//=============== STAMPA ARRAY ==================//
echo "Primo elemento dell'array: " . $arr[0] . "<br><br>";
echo "Array completo:\n";
foreach ($arr as $elemento) {
    echo $elemento . " ";
}

// per evitare lo spazio finale
echo "<br>Array completo:\n";
echo implode(", ", $arr);

// stampato con print_r
echo "<br>Array completo:\n";
print_r($arr);


//=============== AGGIUNGI ==================//
echo "<br><br>Aggiunggo all'array il numero 105";
array_push($arr, 105);
echo "<br>Array completo:\n";
echo implode(", ", $arr);


//=============== CANCELLA ==================//
print("<br><br>Cancella elemento\n");
array_pop($arr);
echo "<br>Array completo:\n";
echo implode(", ", $arr);


//=============== CONTROLLO ==================//
if (in_array(10, $arr)) {
    echo "il numero esiste";
} else {
    echo "il numero non esiste nel vettore";
}

//=============== SORT ==================//
sort($arr);
echo implode(" ", $arr);


/*VARIABILI:
  - scalari
  - composti (array, array associativi, oggetti)
  - pseudo_valori, funzioni (callback)
  - definite/non-definite
  - set o non set
  - null o != null
  - isset(), isempty(), isnull()
  - falsy (0, 0.0, "0", false, "", [], null)
  - truthy (true, numero, " ", [......], ".....")
  - loose (==), strict (===)
*/

//=============== ARRAY ASSOCIATIVO ==================//
$studente = [
    "nome" => "Marco",
    "età" => 18,
];

echo "<br><br>" . $studente["nome"];
$studente["cognome"] = "Bianchi";

foreach ($studente as $chiave => $valore) {
    echo "<br>$chiave: $valore";
}

echo "<br>Vettore associativo annidato <br>";
$studenti = [
    "studente1" => [
        "nome" => "Gigi",
        "voto" => "7"
    ],
    "studente2" => [
        "nome" => "Carlo",
        "voto" => "6.4"
    ],
    "studente3" => [
        "nome" => "Pablo",
        "voto" => "8.75"
    ],
];
echo $studenti["studente2"]["voto"];

if (array_key_exists("nome", $studente)) {
    echo "<br>chiave trovata";
} else {
    echo "<br>chiave non trovata";
}
echo "<br>";
$chiavi = array_keys($studente);
var_dump($chiavi);
$valori = array_values($studente);
echo "<br>";
var_dump($valori);

echo "<br>$valori[1]";
echo "<br>" . $studente["età"];
//verificare che una chiave esista
if (key_exists("età", $studente)) {
    echo "<br>" . $studente["età"];
}

//---------------------------------
$var1 = 5;
$var2 = '5';
$var3 = 'ciao';
//verifica l'uguaglianza con la conversione
if($var1==$var2){
    echo "<br>sono uguali";
}else{
    echo "<br>sono diversi";
}
//verifica l'uguaglianza senza conversione
if($var1===$var2){
    echo "<br>sono uguali";
}else{
    echo "<br>sono diversi";
}
if($var3 == 0){
    echo "<br>sono uguali";
}else{
    echo "<br>sono diversi";
}

$var = null;
//funzione isset(), vede se la variabile esiste oppure se è diversa da null
if(isset($var)){
    echo "<br>esiste";
}else{
    echo "<br>non esiste";
}

//funzione isnull(), vede se la variabile è esattamente null
if(is_null($var)){
    echo "<br>esiste";
}else{
    echo "<br>non esiste";
}

//funzione empty(), vede se la variabile è 0

