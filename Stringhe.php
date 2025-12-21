<?php

// strlen() – lunghezza di una stringa
$testo = "Ciao mondo";
echo strlen($testo);
echo '<br>';

// strrev() – inverte una stringa
echo strrev("Ciao");
echo '<br>';

// strtolower() – converte in minuscolo
echo strtolower("CIAO MONDO");
echo '<br>';

// strtoupper() – converte in maiuscolo
echo strtoupper("ciao mondo");
echo '<br>';

// ucfirst() – prima lettera maiuscola
echo ucfirst("ciao mondo");
echo '<br>';

// ucwords() – prima lettera maiuscola di ogni parola
echo ucwords("ciao mondo");
echo '<br>';

// trim() – rimuove spazi all’inizio e alla fine
$testo = "   ciao   ";
echo trim($testo);
echo '<br>';

// ltrim() – rimuove spazi a sinistra
echo ltrim("   ciao");
echo '<br>';

// rtrim() – rimuove spazi a destra
echo rtrim("ciao   ");
echo '<br>';

// explode() – divide una stringa in un array
$frase = "rosso,verde,blu";
$array = explode(",", $frase);
var_dump($array);
echo '<br>';

// implode() – unisce un array in una stringa
$colori = ["rosso", "verde", "blu"];
echo implode(", ", $colori);
echo '<br>';

// str_replace() – sostituisce testo
echo str_replace("mondo", "PHP", "Ciao mondo");
echo '<br>';

// substr() – estrae una parte di stringa
echo substr("Programmazione", 0, 7);
echo '<br>';

// strpos() – posizione della prima occorrenza
echo strpos("Ciao mondo", "mondo");
echo '<br>';

// strrpos() – posizione dell’ultima occorrenza
echo strrpos("uno due uno", "uno");
echo '<br>';

// strstr() – restituisce parte della stringa dalla prima occorrenza
echo strstr("email@gmail.com", "@");
echo '<br>';

// stristr() – come strstr ma case-insensitive
echo stristr("Ciao Mondo", "mondo");
echo '<br>';

// sprintf() – formatta una stringa
$testo = sprintf("Ciao %s, hai %d anni", "Luca", 25);
echo $testo;
echo '<br>';

// printf() – stampa una stringa formattata
printf("Prezzo: %.2f €", 12.5);
echo '<br>';

// number_format() – formatta un numero
echo number_format(1234.567, 2, ",", ".");
echo '<br>';

// addslashes() – aggiunge backslash ai caratteri speciali
$testo = "L'amico di \"Mario\"";
echo addslashes($testo);
echo '<br>';

// stripslashes() – rimuove i backslash
$testo = "L\'amico di \"Mario\"";
echo stripslashes($testo);