<?php

$num = -10;
if($num<0){
    //die('NUMERO NEGATIVO NON CONSENTITO!!!!!!!!!!!!!!!!!');
    //header("Location: error_page.php?msg = numero negativo");
    $msg = 'numero brutto';
    include 'error_page.php'; // con include è più bello perchè così invece che fare 2 richieste ne fa 1, visto che non viene ridirezionato
    http_response_code(413);
}
