<?php

$text = 'mondo ciao';
echo preg_match("#mondo#", $text) ? 'Pattern trovato' : 'Pattern non trovato';
echo '<br>';
echo preg_match("#^mondo#", $text) ? "Pattern trovato all'inizio" : "Pattern non trovato";//con ^ cerca se il pattern è all'inizip
echo '<br>';
echo preg_match("#mondo$#", $text) ? "Pattern trovato alla fine" : "Pattern non trovato";//con $ cerca se il pattern è alla fine
echo '<br>';
echo preg_match("#[0-9]#", 'ciao5atutti') ? "Pattern numerico trovato" : "Pattern non trovato";//con [0-9] cerca un pattern di almeno 1 numero all'interno della stringa
echo '<br>';
echo preg_match("#[a-z]#", 'ciao a tutti') ? "Pattern di lettere minuscole trovato" : "Pattern non trovato";//con [a-z] cerca ALMENO 1 lettera MINUSCOLA nella stringa
echo '<br>';
echo preg_match("#[A-Z]#", 'ciao a tuTti') ? "Pattern di lettere maiuscole trovato" : "Pattern non trovato";//con [A-Z] cerca ALMENO 1 lettera MAIUSCOLA nella stringa
echo '<br>';
echo preg_match("#[^0-9]#", 'ciao a tuTti') ? "Pattern con mancanza di numeri" : "Pattern contiene numeri";//il ^ dentro alla parentesi quadra significa una negazione, basta che ci siano SOLO numeri
echo '<br>';
echo preg_match("#[^a-z]#", 'ciaoatutti') ? "Pattern con mancanza di lettere" : "Pattern non trovato";//stessa cosa dei numeri ma con le lettere, ATTENZIONE AGLI SPAZI
echo '<br>';
echo preg_match("#R[aeiou]vigo#", 'Rovigo') ? "Pattern Rovigo trovato" : "Pattern non trovato";//una delle lettere all'interno della parentesi quadra DEVE essere trovata
echo '<br>';
echo preg_match("#R[aeiou]?vigo#", 'Roaivigo') ? "Pattern Rovigo trovato" : "Pattern non trovato";//deve trovare o 1 o nessuna
echo '<br>';
echo preg_match("#R[aeiou]*vigo#", 'Roaivigo') ? "Pattern Rovigo trovato" : "Pattern non trovato";//deve trovare nessuno/1/infiniti cacratteri all'interno del pattern
echo '<br>';
echo preg_match("#R[aeiou]+vigo#", 'Roiavigo') ? "Pattern Rovigo trovato" : "Pattern non trovato";//deve trovare 1/infiniti caratteri all'interno del pattern
echo '<br>';
echo preg_match("#R[aeiou]vigo[0-9]?#", 'Rovigo5') ? "Pattern Rovigo trovato" : "Pattern non trovato";
preg_match("#R[aeiou]vigo[0-9]?#", 'Rovigo5', $matches) ? "Pattern Rovigo trovato" : "Pattern non trovato";
echo '<br>';
var_dump($matches);
preg_match("#R[aeiou]*#", 'Reavigo', $matches_) ? "Pattern Rovigo trovato" : "Pattern non trovato";
echo '<br>';
var_dump($matches_);
echo '<br>';
echo preg_match("#ciao#i", "CIAO") ? "Pattern trovato" : "Pattern non trovato";//rende case insensitive con la #i
echo '<br>';
$tot = "0123456789";
echo preg_match("#[0-9]{3,10}#", $tot, $matches__) ? "true" : "false";//{3,10} vuol dire che deve trovare una serie di minimo 3 e massimo 10 cifre numeriche nel range [0-9]
echo '<br>';
var_dump($matches__);
echo '<br>';
echo preg_match("#verde|rosso|blu#","ciao a rosso")? "true":"false";//cerca se c'è almeno 1 dei 3 colori


