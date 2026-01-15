<?php
// Struttura dati
$discipline = [
    "INFORMATICA"=>[
        "C:\Users\Marcello\IdeaProjects\repo-PHP\RipassoItinere\Informatica"=>[
            "argomento" => "Programmazione PHP",
            "mese" => 1,
            "file" => ".\Informatica\info.txt"
        ]
    ],
    "SISTEMI" =>[
        "C:\Users\Marcello\IdeaProjects\repo-PHP\RipassoItinere\Sistemi" => [
            "argomento" => "Server",
            "mese" => 2,
            "file" => ".\Sistemi\sistemi.txt"
        ]
    ],
    "TPSIT" => [
        "C:\Users\Marcello\IdeaProjects\repo-PHP\RipassoItinere\Tpsit" => [
            "argomento" => "Python",
            "mese" => 3,
            "file" => ".\Tpsit\ tpsit.txt"
        ]
    ]
];

foreach ($discipline as $disc => $percorsi) {
    foreach ($percorsi as $percorso => $dati) {
        $riga = implode(",", [$dati['argomento'], $dati['mese']]);
        file_put_contents($dati['file'], $riga);
    }
}
function estraiArgomento($struttura,$disciplina,$percorso) {
if(!isset($struttura[$disciplina][$percorso])){
    return "Percorso/Disciplina non validi!!";
}
$file = $struttura[$disciplina][$percorso]["file"];

$file2 = fopen($file, "r");
if ($file2 === FALSE) {return null;}

$riga = fgets($file2);
fclose($file2);

$dati = explode(",",trim($riga));

return [
    "argomento" => $dati[0],
    "mese" => $dati[1]
];
}

function inserisciArgomento($struttura,$disciplina,$percorso,$argomento,$mese,$file) {
    $disciplineConsentite = ["INFORMATICA","SISTEMI","TPSIT"];
    if(!in_array($disciplina,$disciplineConsentite)){
        return "Disciplina non valida";
    }
    if(isset($struttura[$disciplina][$percorso])){
        return "Percorso già presente";
    }
    if($mese<1 || $mese > 12){
        return " Mese non valido";
    }
    $riga = implode(",",[$argomento,$mese]);
    $var = fopen($percorso, "w");
    fwrite($var, $riga);
    fclose($var);

    $struttura[$disciplina][$percorso] = [
        "argomento" => $argomento,
        "mese" => $mese,
        "file" => $file
    ];
    return "Inserimento completato";
}

$risultato = estraiArgomento($discipline,"TPSIT","C:\Users\Marcello\IdeaProjects\repo-PHP\RipassoItinere\Tpsit");

echo "Estratto file: <br>";
echo "Argomento " . $risultato["argomento"] . "<br>";
echo "Mese " . $risultato["mese"] . "<br>";

echo inserisciArgomento(
    $discipline,
    "INFORMATICA",
    ".\Informatica\schemi.txt",
    "Schemi E/R",
    4,
    "schemi.txt"
);
echo "<hr>";
var_dump($discipline);
