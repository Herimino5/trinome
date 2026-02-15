<?php $title = 'Mes Produits'; include __DIR__ . '/../layout/header.php'; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Mes Produits</h1>
        <a href="<?= BASE_URL ?>products/create" class="btn btn-success">+ Nouveau Produit</a>
    </div>

    <?php if (!empty($products) && count($products) > 0): ?>
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
            <?php foreach ($products as $product): ?>
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
                <td><?= number_format($product['price'], 2, ',', ' ') ?> €</td>
                <td><?= htmlspecialchars($product['category_name'] ?? '—') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                    <a href="<?= BASE_URL ?>products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="<?= BASE_URL ?>products/delete/<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun produit trouvé.</div>
    <?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
