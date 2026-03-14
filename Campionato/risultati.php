<?php
require './configurations/dbConf.php';
$config = require 'configurations/dbConfig.php';
$db = dbConf::getDB($config);

$msg = '';
$selCampionato = '';
$selData = '';

$campionati = $db->query('SELECT nome FROM campionati ORDER BY nome')->fetchAll(PDO::FETCH_ASSOC);
$piloti = $db->query('SELECT cf, nome, cognome, numero FROM piloti ORDER BY numero')->fetchAll(PDO::FETCH_ASSOC);

$selCampionato = $_GET['campionato'] ?? $_POST['camp_gara'] ?? '';
$selData       = $_GET['data']       ?? $_POST['data_gara'] ?? '';

if (isset($_POST['salva_risultato'])) {
    $dg  = $_POST['data_gara'];
    $cg  = $_POST['camp_gara'];
    $cf  = strtolower(trim($_POST['cf_pilota']));
    $pts = (int)$_POST['punti'];
    $tpo = trim($_POST['tempo']) ?: null;
    try {
        $db->prepare('INSERT INTO partecipazione (dataGara, campionatoGara, cfPilota, punti, tempo)
                      VALUES (?, ?, ?, ?, ?)
                      ON DUPLICATE KEY UPDATE punti=VALUES(punti), tempo=VALUES(tempo)')
                ->execute([$dg, $cg, $cf, $pts, $tpo]);
        $msg = 'Risultato salvato!';
    } catch (PDOException $e) {
        $msg = 'Errore: ' . $e->getMessage();
    }
}

// ── Gare del campionato selezionato ──
$gare = [];
if ($selCampionato) {
    $s = $db->prepare('SELECT data FROM gare WHERE nomeCampionato = ? ORDER BY data');
    $s->execute([$selCampionato]);
    $gare = $s->fetchAll(PDO::FETCH_ASSOC);
}

$risultati   = [];
$tempoVeloce = null;
if ($selCampionato && $selData) {
    $s = $db->prepare('SELECT par.cfPilota,
                              CONCAT(pi.nome, " ", pi.cognome) AS nome_pilota,
                              pi.nomeCasa AS casa, par.punti, par.tempo
                       FROM partecipazione par
                       JOIN piloti pi ON pi.cf = par.cfPilota
                       WHERE par.campionatoGara = ? AND par.dataGara = ?
                       ORDER BY par.punti DESC');
    $s->execute([$selCampionato, $selData]);
    $risultati = $s->fetchAll(PDO::FETCH_ASSOC);

    $conTempo = [];
    foreach ($risultati as $r) {
        if (!empty($r['tempo'])) {
            $conTempo[] = $r;
        }
    }
    if ($conTempo) {
        usort($conTempo, function($a, $b) {
            return strcmp($a['tempo'], $b['tempo']);
        });
        $tempoVeloce = $conTempo[0];
    }
}

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
    <title>Risultati — Race Manager</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="iscrizioni.php">Iscrizioni</a>
    <a href="risultati.php" class="active">Risultati</a>
    <a href="classifiche.php">Classifiche</a>
</nav>
    <h1>Risultati</h1>
    <?php if ($msg): ?><div class="msg-ok"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

    <div class="grid-2">

        <div class="card">
            <h2>SELEZIONA GARA</h2>
            <form method="GET">
                <label>Campionato</label>
                <select name="campionato" onchange="this.form.submit()">
                    <option value="">SELEZIONA</option>
                    <?php foreach ($campionati as $c): ?>
                        <option value="<?= htmlspecialchars($c['nome']) ?>"
                                <?= $selCampionato === $c['nome'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if ($selCampionato && $gare): ?>
                    <label>Data Gara</label>
                    <select name="data" onchange="this.form.submit()">
                        <option value="">-- Seleziona --</option>
                        <?php foreach ($gare as $g): ?>
                            <option value="<?= $g['data'] ?>"
                                    <?= $selData === $g['data'] ? 'selected' : '' ?>>
                                <?= $g['data'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </form>
        </div>

        <div class="card">
            <h2>INSERISCI RISULTATO</h2>
            <?php if (!$selCampionato || !$selData): ?>
                <p style="color:#666;font-size:13px">Seleziona prima un campionato e una gara.</p>
            <?php else: ?>
                <form method="POST">
                    <input type="hidden" name="data_gara" value="<?= htmlspecialchars($selData) ?>">
                    <input type="hidden" name="camp_gara" value="<?= htmlspecialchars($selCampionato) ?>">
                    <label>Pilota</label>
                    <select name="cf_pilota" required>
                        <option value="">-- Seleziona --</option>
                        <?php foreach ($piloti as $p): ?>
                            <option value="<?= htmlspecialchars($p['cf']) ?>">
                                <?= htmlspecialchars($p['numero'] . ' — ' . $p['nome'] . ' ' . $p['cognome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="grid-2-small">
                        <div>
                            <label>Punti</label>
                            <input type="number" name="punti" min="0" required>
                        </div>
                        <div>
                            <label>Tempo</label>
                            <input type="text" name="tempo" placeholder="01:30:15.221">
                        </div>
                    </div>
                    <button name="salva_risultato">Salva</button>
                </form>
            <?php endif; ?>
        </div>

    </div>

    <?php if ($risultati): ?>
        <div class="card">
            <h2>RISULTATI — <?= htmlspecialchars($selData) ?></h2>

            <div class="podium">
                <?php
                $posizioni = ['p1', 'p2', 'p3'];
                $medaglie  = ['🥇', '🥈', '🥉'];
                foreach (array_slice($risultati, 0, 3) as $i => $r):
                    ?>
                    <div class="pbox <?= $posizioni[$i] ?>">
                        <div class="medal"><?= $medaglie[$i] ?></div>
                        <div class="pd-name"><?= htmlspecialchars($r['nome_pilota']) ?></div>
                        <div class="pd-team"><?= htmlspecialchars($r['casa']) ?></div>
                        <div class="pd-pts"><?= $r['punti'] ?> pt</div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($tempoVeloce): ?>
                <div class="fastest">
                    <div>
                        <div class="fl-label">Giro Veloce</div>
                        <div class="fl-name"><?= htmlspecialchars($tempoVeloce['nome_pilota']) ?></div>
                    </div>
                    <div class="fl-time"><?= htmlspecialchars($tempoVeloce['tempo']) ?></div>
                </div>
            <?php endif; ?>

            <table>
                <thead>
                <tr><th>Pos</th><th>Pilota</th><th>Casa</th><th>Punti</th><th>Tempo</th></tr>
                </thead>
                <tbody>
                <?php foreach ($risultati as $i => $r): ?>
                    <tr>
                        <td class="<?= posClass($i) ?>" style="font-weight:bold"><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($r['nome_pilota']) ?></td>
                        <td style="color:#888"><?= htmlspecialchars($r['casa']) ?></td>
                        <td class="pos-1" style="font-weight:bold"><?= $r['punti'] ?></td>
                        <td style="font-family:monospace;color:#888"><?= htmlspecialchars($r['tempo'] ?? '—') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</body>
</html>