<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);
session_start();

// CONTROLLO LOGIN INLINE
if (!isset($_SESSION['user_cf'])) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

$sedi = $db->query("SELECT * FROM sedi")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cfMittente = $_POST['cf_mittente'];
    $cfDestinatario = $_POST['cf_destinatario'];
    $sedePartenza = $_POST['sede_partenza'];
    $sedeArrivo = $_POST['sede_arrivo'];

    // Verifica/inserisci mittente
    $stmt = $db->prepare("SELECT cf FROM clienti WHERE cf = ?");
    $stmt->execute([$cfMittente]);
    if (!$stmt->fetch()) {
        $stmt = $db->prepare("INSERT INTO persone (cf, nome, cognome, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$cfMittente, $_POST['nome_mittente'], $_POST['cognome_mittente'], $_POST['email_mittente']]);
        $stmt = $db->prepare("INSERT INTO clienti (cf) VALUES (?)");
        $stmt->execute([$cfMittente]);
    }

    // Verifica/inserisci destinatario
    $stmt = $db->prepare("SELECT cf FROM destinatari WHERE cf = ?");
    $stmt->execute([$cfDestinatario]);
    if (!$stmt->fetch()) {
        $stmt = $db->prepare("INSERT INTO persone (cf, nome, cognome, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$cfDestinatario, $_POST['nome_destinatario'], $_POST['cognome_destinatario'], $_POST['email_destinatario']]);
        $stmt = $db->prepare("INSERT INTO destinatari (cf) VALUES (?)");
        $stmt->execute([$cfDestinatario]);
    }

    // Inserisci plico
    $data = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO plichi (cfMittente, cfDestinatario, sedePartenza, sedeArrivo, dataAcc) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$cfMittente, $cfDestinatario, $sedePartenza, $sedeArrivo, $data])) {
        $db->prepare("UPDATE clienti SET puntiFedelta = puntiFedelta + 1 WHERE cf = ?")->execute([$cfMittente]);
        $success = "Consegna registrata con successo!";
    } else {
        $error = "Errore nella registrazione";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nuova consegna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>📦 Nuova consegna</h2>
        <a href="dashboard.php">← Torna alla dashboard</a>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <h3>Mittente</h3>
            <div class="form-group">
                <label>Codice Fiscale:</label>
                <input type="text" name="cf_mittente" required>
            </div>
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome_mittente" required>
            </div>
            <div class="form-group">
                <label>Cognome:</label>
                <input type="text" name="cognome_mittente" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email_mittente" required>
            </div>

            <h3>Destinatario</h3>
            <div class="form-group">
                <label>Codice Fiscale:</label>
                <input type="text" name="cf_destinatario" required>
            </div>
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome_destinatario" required>
            </div>
            <div class="form-group">
                <label>Cognome:</label>
                <input type="text" name="cognome_destinatario" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email_destinatario" required>
            </div>

            <h3>Spedizione</h3>
            <div class="form-group">
                <label>Sede partenza:</label>
                <select name="sede_partenza" required>
                    <?php foreach($sedi as $s): ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo $s['nome'] . " - " . $s['citta']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Sede arrivo:</label>
                <select name="sede_arrivo" required>
                    <?php foreach($sedi as $s): ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo $s['nome'] . " - " . $s['citta']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Registra consegna</button>
        </form>
    </div>
</div>
</body>
</html>