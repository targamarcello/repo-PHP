<?php

// abs() – valore assoluto
echo abs(-10);
echo '<br>';

// ceil() – arrotonda per eccesso
echo ceil(4.2);
echo '<br>';

// floor() – arrotonda per difetto
echo floor(4.8);
echo '<br>';

// round() – arrotonda al valore più vicino
echo round(4.5);
echo '<br>';

// mt_rand() – numero casuale (più veloce e migliore)
echo mt_rand(1, 10);
echo '<br>';

// rand() – numero casuale
echo rand(1, 10);
echo '<br>';

// min() – valore minimo
echo min(3, 7, 1, 9);
echo '<br>';

// max() – valore massimo
echo max(3, 7, 1, 9);
echo '<br>';

// sqrt() – radice quadrata
echo sqrt(16);
echo '<br>';

// pow() – potenza
echo pow(2, 3);
echo '<br>';

// intdiv() – divisione intera
echo intdiv(10, 3);
echo '<br>';

// number_format() – formatta un numero
echo number_format(1234.567, 2, ",", ".");
echo '<br>';

// is_numeric() – verifica se è numerico
var_dump(is_numeric("123"));
echo '<br>';

// is_int() – verifica se è intero
var_dump(is_int(10));
echo '<br>';

// is_float() – verifica se è float
var_dump(is_float(10.5));
echo '<br>';

// intval() – converte in intero
echo intval("15.7");
echo '<br>';

// floatval() – converte in float
echo floatval("15.7");
echo '<br>';

// pi() – valore di π
echo pi();
echo '<br>';

// log() – logaritmo naturale
echo log(2.71828); // ~1
echo '<br>';

// exp() – esponenziale (e^x)
echo exp(1); // 2.718281828459