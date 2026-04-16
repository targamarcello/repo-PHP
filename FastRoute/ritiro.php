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

$plici = $db->query("SELECT p.id, CONCAT(pers.nome, ' ', pers.cognome) as mittente 
                     FROM plichi p
                     JOIN clienti c ON p.cfMittente = c.cf
                     JOIN persone pers ON c.cf = pers.cf
                     WHERE p.dataSpend IS NOT NULL AND p.dataRit IS NULL")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_plico'];
    $data = date('Y-m-d H:i:s');

    $stmt = $db->prepare("UPDATE plichi SET dataRit = ? WHERE id = ? AND dataRit IS NULL");
    if ($stmt->execute([$data, $id])) {
        $success = "Ritiro registrato!";
    } else {
        $error = "Errore";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registra ritiro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>✅ Registra ritiro</h2>
        <a href="dashboard.php">← Torna alla dashboard</a>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Seleziona plico:</label>
                <select name="id_plico" required>
                    <option value="">Scegli...</option>
                    <?php foreach($plici as $p): ?>
                        <option value="<?php echo $p['id']; ?>">Plico #<?php echo $p['id']; ?> - <?php echo $p['mittente']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Registra ritiro</button>
        </form>
    </div>
</div>
</body>
</html>