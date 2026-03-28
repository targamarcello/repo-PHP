<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);

$campionati = $db->query("SELECT nome FROM campionati ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

$selCamp = $_GET['campionato'] ?? '';

$piloti = [];
$costruttori = [];

if ($selCamp) {
    $s = $db->prepare('
        SELECT CONCAT(pi.nome, " ", pi.cognome) AS nome,
               pi.nazionalità,
               pi.nomeCasa AS casa,
               COALESCE(SUM(par.punti), 0) AS punti,
               COUNT(par.cfPilota) AS gare
        FROM piloti pi
        LEFT JOIN partecipazione par ON par.cfPilota = pi.CF AND par.campionatoGara = ?
        GROUP BY pi.CF, pi.nome, pi.cognome, pi.nazionalità, pi.nomeCasa
        HAVING punti > 0
        ORDER BY punti DESC
    ');
    $s->execute([$selCamp]);
    $piloti = $s->fetchAll(PDO::FETCH_ASSOC);

    $s = $db->prepare('
        SELECT pi.nomeCasa AS casa,
               COALESCE(SUM(par.punti), 0) AS punti
        FROM piloti pi
        LEFT JOIN partecipazione par ON par.cfPilota = pi.CF AND par.campionatoGara = ?
        GROUP BY pi.nomeCasa
        HAVING punti > 0
        ORDER BY punti DESC
    ');

    $s->execute([$selCamp]);
    $costruttori = $s->fetchAll(PDO::FETCH_ASSOC);
}

$maxP = $piloti[0]['punti'] ?? 1;  // ← 1 e non 0, sennò dividi per zero nelle barre
$maxC = $costruttori[0]['punti'] ?? 1;
$medaglie = ['🥇', '🥈', '🥉'];

function posClass(int $i): string {
    if ($i === 0) return 'pos-1';
    if ($i === 1) return 'pos-2';
    if ($i === 2) return 'pos-3';
    return 'pos-n';
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifiche — Race Manager</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="iscrizioni.php">Iscrizioni</a>
    <a href="risultati.php"> Risultati</a>
    <a href="classifiche.php">Classifiche</a>
</nav>
<main>

    <h1>Classifiche</h1>

    <form method="GET" style="margin-bottom:24px">
        <label>Campionato</label>
        <select name="campionato" onchange="this.form.submit()" style="width:320px">
            <option value="">-- Seleziona --</option>
            <?php foreach ($campionati as $c): ?>
                <option value="<?= htmlspecialchars($c['nome']) ?>"
                        <?= $selCamp === $c['nome'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if (!$selCamp || (!$piloti && !$costruttori)): ?>
        <p style="color:#666">Seleziona un campionato con risultati inseriti.</p>
    <?php else: ?>

        <div class="grid-2">

            <div class="card">
                <h2>CLASSIFICA PILOTI</h2>
                <?php foreach ($piloti as $i => $p): ?>
                    <div class="rank-row">
                        <div class="rank-top">
                            <div class="rank-left">
                        <span class="<?= posClass($i) ?>" style="font-weight:bold;width:26px">
                            <?= $medaglie[$i] ?? $i + 1 ?>
                        </span>
                                <div>
                                    <div style="font-weight:<?= $i === 0 ? 'bold' : 'normal' ?>">
                                        <?= htmlspecialchars($p['nome']) ?>
                                    </div>
                                    <div class="rank-sub">
                                        <?= htmlspecialchars($p['casa']) ?> · <?= $p['gare'] ?> gare
                                    </div>
                                </div>
                            </div>
                            <span class="rank-pts <?= posClass($i) ?>"><?= $p['punti'] ?></span>
                        </div>
                        <div class="bar-bg">
                            <div class="bar-fill" style="width:<?= round($p['punti'] / $maxP * 100) ?>%;
                                    background:<?= ['gold','silver','#cd7f32'][$i] ?? '#555' ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="card">
                <h2>CLASSIFICA COSTRUTTORI</h2>
                <?php foreach ($costruttori as $i => $c): ?>
                    <div class="rank-row">
                        <div class="rank-top">
                            <div class="rank-left">
                        <span class="<?= posClass($i) ?>" style="font-weight:bold;width:26px">
                            <?= $medaglie[$i] ?? $i + 1 ?>
                        </span>
                                <span style="font-weight:<?= $i === 0 ? 'bold' : 'normal' ?>">
                            <?= htmlspecialchars($c['casa']) ?>
                        </span>
                            </div>
                            <span class="rank-pts <?= posClass($i) ?>"><?= $c['punti'] ?></span>
                        </div>
                        <div class="bar-bg">
                            <div class="bar-fill" style="width:<?= round($c['punti'] / $maxC * 100) ?>%;
                                    background:<?= ['gold','silver','#cd7f32'][$i] ?? '#555' ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <?php if ($piloti): ?>
            <div class="card">
                <h2>DETTAGLI PILOTI</h2>
                <table>
                    <thead>
                    <tr><th>Pos</th><th>Pilota</th><th>Nazionalità</th><th>Casa</th><th>Gare</th><th>Punti</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($piloti as $i => $p): ?>
                        <tr>
                            <td class="<?= posClass($i) ?>" style="font-weight:bold"><?= $i + 1 ?></td>
                            <td style="font-weight:<?= $i === 0 ? 'bold' : 'normal' ?>"><?= htmlspecialchars($p['nome']) ?></td>
                            <td style="color:#666"><?= htmlspecialchars($p['nazionalità']) ?></td>
                            <td><?= htmlspecialchars($p['casa']) ?></td>
                            <td style="color:#666"><?= $p['gare'] ?></td>
                            <td class="pos-1" style="font-weight:bold"><?= $p['punti'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</main>
</body>
</html>