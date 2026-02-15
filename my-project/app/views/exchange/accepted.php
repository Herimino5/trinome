<?php $title = 'Echanges acceptes'; include __DIR__ . '/../layout/header.php'; ?>
<h1 class="mb-4">Echanges acceptes</h1>
<?php if (empty($exchanges)): ?>
    <div class="alert alert-info">Aucun echange accepte.</div>
<?php else: ?>
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Produit propose</th>
            <th>Produit demande</th>
            <th>Propose par</th>
            <th>Proprietaire demande</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($exchanges as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['myproduct']) ?></td>
            <td><?= htmlspecialchars($e['desiredproduct']) ?></td>
            <td><?= htmlspecialchars($e['proposer']) ?></td>
            <td><?= htmlspecialchars($e['receiver']) ?></td>
            <td><?= htmlspecialchars($e['exchange_date']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
