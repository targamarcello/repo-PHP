<?php
echo "Operatore ternario";
$x = 5;
echo "<br>";
$risultato = $x > 6 ? "bellissimo" : "niente";
var_dump($risultato);

echo"<br>Operatore coalessing";
echo "<br>";
$risultato = $nome ?? "default";
var_dump($risultato);

echo "<br>Operatore spaceship:";
echo "<br>";
$x = 6;
$z =3;
echo $z <=> $x;

echo "<br>";

$stringa = "ciao a tutti";
echo "Strlen lunghezza stringa:";
echo "<br>";
echo strlen($stringa);

//datetime
$data = new DateTime();
echo $data->format("d/m/y H:i:s");
echo "<br>Data di oggi".$data->format("H:i:s");
echo "<br>Data di oggi".$data->format("d/m/y");
echo "<br>Data di oggi".$data->format("d/m/y H:i:s");

$data   -> modify("+2 days");
echo "<br>Data di oggi +2 giorn".$data->format("d/m/y");

$data2 = new DateTime("-2 days");
echo "<br>Data di oggi +2 giorn".$data2->format("d/m/y");

echo "<br>Differenza di 2 date: ";
$diff1 = new DateTime("2025/01/10");
$diff2 = new DateTime("2025/01/15");
$diffona = $diff1 ->diff($diff2);
echo $diffona->days;
echo "<br>";
echo $diffona->y;

$intervalTime = new DateInterval("P1Y3M4DT2H3M4S");
$newDate  = $diff1->add($intervalTime);