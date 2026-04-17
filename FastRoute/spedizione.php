<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);
session_start();

if (!isset($_SESSION['user_cf'])) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

$plici = $db->query("SELECT p.id, CONCAT(pers.nome, ' ', pers.cognome) as mittente 
                     FROM plichi p
                     JOIN clienti c ON p.cfMittente = c.cf
                     JOIN persone pers ON c.cf = pers.cf
                     WHERE p.dataSpend IS NULL AND p.dataAcc IS NOT NULL")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_plico'];
    $data = date('Y-m-d H:i:s');

    $stmt = $db->prepare("UPDATE plichi SET dataSpend = ? WHERE id = ? AND dataSpend IS NULL");
    if ($stmt->execute([$data, $id])) {
        $success = "Spedizione registrata!";
    } else {
        $error = "Errore";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registra spedizione</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2> Registra spedizione</h2>
        <a href="dashboard.php">← Torna alla dashboard</a>

        <?php if($error): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="success"><?= $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Seleziona plico:</label>
                <select name="id_plico" required>
                    <option value="">Scegli...</option>
                    <?php foreach($plici as $p): ?>
                        <option value="<?= $p['id']; ?>">Plico #<?= $p['id']; ?> - <?= $p['mittente']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Registra spedizione</button>
        </form>
    </div>
</div>
</body>
</html>
