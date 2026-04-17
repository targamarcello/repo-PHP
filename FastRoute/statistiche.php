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

$result = null;
$days = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $days = intval($_POST['days']);
    if ($days > 0) {
        $stmt = $db->prepare("SELECT COUNT(*) as totale FROM plichi 
                              WHERE dataRit IS NOT NULL 
                              AND dataRit >= DATE_SUB(NOW(), INTERVAL ? DAY)");
        $stmt->execute([$days]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$totali = $db->query("SELECT 
    COUNT(*) as tot,
    SUM(CASE WHEN dataRit IS NOT NULL THEN 1 ELSE 0 END) as ritirati,
    SUM(CASE WHEN dataSpend IS NOT NULL AND dataRit IS NULL THEN 1 ELSE 0 END) as transito
FROM plichi")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Statistiche</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Statistiche</h2>
        <a href="dashboard.php">← Torna alla dashboard</a>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-number"><?= $totali['tot']; ?></div>
                <p>Totale spedizioni</p>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?= $totali['ritirati']; ?></div>
                <p>Ritirati</p>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?= $totali['transito']; ?></div>
                <p>In transito</p>
            </div>
        </div>

        <h3>Plici ritirati negli ultimi N giorni</h3>
        <form method="POST">
            <div class="form-group">
                <label>Giorni:</label>
                <input type="number" name="days" min="1" required>
            </div>
            <button type="submit">Calcola</button>
        </form>

        <?php if($result): ?>
            <div style="margin-top: 20px; padding: 20px; background: #e8f5e9; text-align: center;">
                <div class="stat-number"><?= $result['totale']; ?></div>
                <p>plici ritirati negli ultimi <?= $days; ?> giorni</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
