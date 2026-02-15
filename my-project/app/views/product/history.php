<?php $title = 'Historique des echanges'; include __DIR__ . '/../layout/header.php'; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">Historique des echanges</h1>
            <?php if (!empty($product)): ?>
                <div class="text-muted">Produit: <?= htmlspecialchars($product['name']) ?></div>
            <?php endif; ?>
        </div>
        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>products-with-owner">Retour a la liste</a>
    </div>

    <?php if (!empty($history)): ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Date et heure</th>
                    <th>Ancien proprietaire</th>
                    <th>Nouveau proprietaire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['exchanged_at']) ?></td>
                        <td><?= htmlspecialchars($row['from_username']) ?></td>
                        <td><?= htmlspecialchars($row['to_username']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun echange pour ce produit.</div>
    <?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
