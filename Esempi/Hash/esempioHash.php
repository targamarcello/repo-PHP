<?php
$pass = '23452bg,lu5459';
$passHash = password_hash($pass,PASSWORD_DEFAULT);

echo $passHash;
echo '<br>';
echo strlen($passHash);
echo '<br>';

if(password_verify($pass,$passHash)){
    echo 'giusta';
}else{
    echo 'sbagliata';
}