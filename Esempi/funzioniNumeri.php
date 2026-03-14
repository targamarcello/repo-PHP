<?php

//abs() valore assoluto
echo abs(-27);
echo '<br>';

//ceil() arrotondamento per eccesso
echo ceil(41.1);
echo '<br>';

//floor() arrotonda per difetto
echo floor(41.9);
echo '<br>';

//round() arrotondamento al più vicino
echo round(41.5);
echo '<br>';

//mt_rand() numero casuale (generato velocemente)
echo mt_rand(1,10);
echo '<br>';

//rand() numero casuale (generato più lentamente)
echo rand(1,10);
echo '<br>';

//min() trova il numero più piccolo
echo min(5,1,6,2,19);
echo '<br>';

//max() trova il numero più grande
echo max(15,51,27,14,73);
echo '<br>';

//sqrt() radice quadrata
echo sqrt(4);
echo '<br>';

//pow() elevamento potenza
echo pow(24);
echo '<br>';

//intdiv() divisione di interi
echo intdiv(9,3);
echo '<br>';

//number_format()
//is_numeric() verifica se un valore è numerico
var_dump(is_numeric('215'));
echo '<br>';

//is_int() verifica se un valore è intero
var_dump(is_int(1265));
echo '<br>';

//is_float() verifica se un valore è float
var_dump(is_float(12.51));
echo '<br>';

//intval() converte in intero
echo intval("17");
echo '<br>';

//floatval() converte in float
echo floatval("51.6");
echo '<br>';

//pi() valore pigreco
echo pi();
echo '<br>';

//log() esegue il logaritmo
echo log(15);
echo '<br>';

//exp() esponenziale
echo exp(4);
echo '<br>';