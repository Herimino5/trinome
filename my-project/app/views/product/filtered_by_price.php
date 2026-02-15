<?php $title = 'Produits Filtrés par Prix'; include __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Produits Filtrés par Prix</h1>
        <p class="text-muted">
            Produit de référence: <strong><?= htmlspecialchars($referenceProduct['name']) ?></strong> 
            (<?= number_format($referenceProduct['price'], 2, ',', ' ') ?> Ar)
        </p>
    </div>
    <a href="<?= BASE_URL ?>products" class="btn btn-secondary">← Retour</a>
</div>

<div class="alert alert-info">
    <strong>Critère de filtre:</strong> Prix ±<?= $percentage ?>%
    <br>
    <small>
        Range de prix: 
        <?= number_format($referenceProduct['price'] * (1 - $percentage/100), 2, ',', ' ') ?> Ar 
        à 
        <?= number_format($referenceProduct['price'] * (1 + $percentage/100), 2, ',', ' ') ?> Ar
    </small>
</div>

<?php if (!empty($filteredProducts) && count($filteredProducts) > 0): ?>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filteredProducts as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td>
                    <?php if (!empty($product['product_image'])): ?>
                        <img src="<?= htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="60" height="60" class="rounded">
                    <?php else: ?>
                        <span class="text-muted">—</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td><?= number_format($product['price'], 2, ',', ' ') ?> Ar</td>
                <td><?= htmlspecialchars($product['category_name'] ?? '—') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                    <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>" class="btn btn-sm btn-primary">Échanger</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning">
        Aucun produit trouvé dans cette plage de prix. Essayez une autre plage de pourcentage.
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
