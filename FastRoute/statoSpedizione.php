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

// FUNZIONE PER LO STATO (inline)
function getStatus($dataAcc, $dataSpend, $dataRit) {
    if ($dataRit) return "Ritirato";
    if ($dataSpend) return "In transito";
    if ($dataAcc) return "In partenza";
    return "In attesa";
}

$info = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_plico'];

    $stmt = $db->prepare("SELECT p.*, 
        CONCAT(p1.nome, ' ', p1.cognome) as mittente,
        CONCAT(p2.nome, ' ', p2.cognome) as destinatario,
        s1.nome as sedePartenza,
        s2.nome as sedeArrivo
    FROM plichi p
    JOIN clienti c ON p.cfMittente = c.cf
    JOIN persone p1 ON c.cf = p1.cf
    JOIN destinatari d ON p.cfDestinatario = d.cf
    JOIN persone p2 ON d.cf = p2.cf
    JOIN sedi s1 ON p.sedePartenza = s1.id
    JOIN sedi s2 ON p.sedeArrivo = s2.id
    WHERE p.id = ?");
    $stmt->execute([$id]);
    $info = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$info) {
        $error = "Plico non trovato";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verifica stato</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>🔍 Verifica stato plico</h2>
        <a href="dashboard.php">← Torna alla dashboard</a>

        <form method="POST">
            <div class="form-group">
                <label>ID Plico:</label>
                <input type="number" name="id_plico" required>
            </div>
            <button type="submit">Cerca</button>
        </form>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($info): ?>
            <div style="margin-top: 20px;">
                <h3>Dettagli spedizione</h3>
                <table>
                    <tr><th>Campo</th><th>Valore</th></tr>
                    <tr><td>ID Plico</td><td><?php echo $info['id']; ?></td></tr>
                    <tr><td>Mittente</td><td><?php echo $info['mittente']; ?></td></tr>
                    <tr><td>Destinatario</td><td><?php echo $info['destinatario']; ?></td></tr>
                    <tr><td>Sede partenza</td><td><?php echo $info['sedePartenza']; ?></td></tr>
                    <tr><td>Sede arrivo</td><td><?php echo $info['sedeArrivo']; ?></td></tr>
                    <tr><td>Data accettazione</td><td><?php echo $info['dataAcc'] ?: '-'; ?></td></tr>
                    <tr><td>Data spedizione</td><td><?php echo $info['dataSpend'] ?: '-'; ?></td></tr>
                    <tr><td>Data ritiro</td><td><?php echo $info['dataRit'] ?: '-'; ?></td></tr>
                    <tr><td><strong>STATO</strong></td>
                        <td><strong><?php echo getStatus($info['dataAcc'], $info['dataSpend'], $info['dataRit']); ?></strong></td>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>