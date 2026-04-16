<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);
session_start();

// CONTROLLO LOGIN
if (!isset($_SESSION['user_cf'])) {
    header('Location: login.php');
    exit();
}

// FUNZIONE STATO
function getStatus($dataAcc, $dataSpend, $dataRit) {
    if ($dataRit) return "Ritirato";
    if ($dataSpend) return "In transito";
    if ($dataAcc) return "In partenza";
    return "In attesa";
}

// Statistiche
$stats = $db->query("SELECT 
    COUNT(*) as totale,
    SUM(CASE WHEN dataRit IS NOT NULL THEN 1 ELSE 0 END) as ritirati
FROM plichi")->fetch(PDO::FETCH_ASSOC);

// Ultimi plici
$plici = $db->query("SELECT p.*, 
    CONCAT(p1.nome, ' ', p1.cognome) as mittente_nome,
    CONCAT(p2.nome, ' ', p2.cognome) as dest_nome
FROM plichi p
JOIN clienti c ON p.cfMittente = c.cf
JOIN persone p1 ON c.cf = p1.cf
JOIN destinatari d ON p.cfDestinatario = d.cf
JOIN persone p2 ON d.cf = p2.cf
ORDER BY p.id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="sidebar">
    <h3 style="color: white; text-align: center;">FastRoute</h3>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="consegna.php">📦 Nuova consegna</a>
    <a href="spedizione.php">🚚 Registra spedizione</a>
    <a href="ritiro.php">✅ Registra ritiro</a>
    <a href="statoSpedizione.php">🔍 Verifica stato</a>
    <a href="statistiche.php">📈 Statistiche</a>
    <a href="cambiaPass.php">🔑 Cambia password</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <div class="card">
        <h2>Benvenuto, <?php echo $_SESSION['user_name']; ?>!</h2>
        <p><?php echo date('d/m/Y H:i:s'); ?></p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-number"><?php echo $stats['totale']; ?></div>
            <p>Totale spedizioni</p>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?php echo $stats['ritirati']; ?></div>
            <p>Ritirati</p>
        </div>
    </div>

    <div class="card">
        <h3>Ultime spedizioni</h3>
        <table>
            <thead>
            <tr><th>ID</th><th>Mittente</th><th>Destinatario</th><th>Stato</th><th>Data acc.</th></tr>
            </thead>
            <tbody>
            <?php foreach($plici as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['mittente_nome']; ?></td>
                    <td><?php echo $p['dest_nome']; ?></td>
                    <td><?php echo getStatus($p['dataAcc'], $p['dataSpend'], $p['dataRit']); ?></td>
                    <td><?php echo $p['dataAcc']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>