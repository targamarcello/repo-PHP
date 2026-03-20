<?php
$allowed = ['jpg', 'png', 'pdf'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['documento']['error'] === UPLOAD_ERR_OK) { //verifica se ci sono stati errori nel caricamento
        $tmp_path = $_FILES["documento"]["tmp_name"];
        $originalName = basename($_FILES['documento']['name']);
        $username = $_POST['nome'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            http_response_code(403);
            $msg = 'estensione non autorizzata';
            include 'errorPage.php';
            exit();
        }

        $maxSize = 2 * 1024;
        $size = $_FILES['documento']['size'];
        if ($size > $maxSize) {
            http_response_code(413);
            $msg = 'dimensione troppo grande';
            include 'errorPage.php';
            exit();
        }
        $userDir = "uploads/" . $username;
        if (!is_dir($userDir)) {
            mkdir($userDir, 0755);
        }
        $destination = $userDir . "/" . $originalName;
        move_uploaded_file($tmp_path, $destination);
        $msg = 'file caricato correttamente';
        include 'message.php';
        exit();
    }else{
        $msg = 'errore del caricamento';
        http_response_code(500);
        include 'message.php';
    }
}





/*
$destination = 'uploads/'.$originalName;
move_uploaded_file($tmp_path,$destination);*/