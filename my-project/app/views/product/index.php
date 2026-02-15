<?php $title = 'Mes Produits'; include __DIR__ . '/../layout/header.php'; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Mes Produits</h1>
        <a href="<?= BASE_URL ?>products/create" class="btn btn-success">+ Nouveau Produit</a>
    </div>

    <!-- Barre de recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Rechercher des produits</h5>
            <form method="GET" action="<?= BASE_URL ?>products" class="row g-3">
                <div class="col-md-6">
                    <label for="keyword" class="form-label">Mot-clé (titre)</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" 
                           placeholder="Rechercher par titre..." 
                           value="<?= htmlspecialchars($keyword ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Toutes les catégories</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['id']) ?>" 
                                    <?= (isset($selectedCategoryId) && $selectedCategoryId == $category['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                </div>
            </form>
            <?php if (!empty($keyword) || !empty($selectedCategoryId)): ?>
                <div class="mt-3">
                    <a href="<?= BASE_URL ?>products" class="btn btn-sm btn-outline-secondary">Réinitialiser la recherche</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-4">
        <p class="text-muted">Filtrer les produits par prix de référence:</p>
        <div class="btn-group" role="group">
            <a href="<?= BASE_URL ?>products" class="btn btn-outline-secondary">Tous les produits</a>
        </div>
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
                <td>
                    <?= number_format($product['price'], 2, ',', ' ') ?> Ar<br>
                    <small class="text-muted">
                        <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>/filter/10" class="text-muted">-/+10%</a>
                        <span class="text-muted">|</span>
                        <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>/filter/20" class="text-muted">-/+20%</a>
                    </small>
                </td>
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
