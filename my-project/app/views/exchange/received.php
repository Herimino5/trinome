<?php $title = 'Propositions d\'échange reçues'; include __DIR__ . '/../layout/header.php'; ?>
<h1 class="mb-4">Propositions d'échange reçues</h1>
<?php if (empty($proposals)): ?>
    <div class="alert alert-info">Aucune proposition reçue.</div>
<?php else: ?>
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Produit demandé</th>
            <th>Produit proposé</th>
            <th>Proposé par</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($proposals as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['desiredproduct']) ?></td>
            <td><?= htmlspecialchars($p['myproduct']) ?></td>
            <td><?= htmlspecialchars($p['proposer']) ?></td>
            <td><?= htmlspecialchars($p['exchange_date']) ?></td>
            <td><?= htmlspecialchars($p['status_name']) ?></td>
            <td>
                <?php if ($p['status_name'] === 'En attente'): ?>
                    <a href="<?= BASE_URL ?>exchange/accept/<?= $p['id'] ?>" class="btn btn-success btn-sm">Accepter</a>
                    <a href="<?= BASE_URL ?>exchange/refuse/<?= $p['id'] ?>" class="btn btn-danger btn-sm">Refuser</a>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
