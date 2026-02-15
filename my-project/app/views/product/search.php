<?php $title = 'Recherche de Produits'; include __DIR__ . '/../layout/header.php'; ?>
    <div class="mb-4">
        <h1>Recherche de Produits</h1>
        <p class="text-muted">Rechercher parmi tous les produits disponibles</p>
    </div>

    <!-- Barre de recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Critères de recherche</h5>
            <form method="GET" action="<?= BASE_URL ?>products/search" class="row g-3">
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
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
            <?php if (!empty($keyword) || !empty($selectedCategoryId)): ?>
                <div class="mt-3">
                    <a href="<?= BASE_URL ?>products/search" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Résultats de recherche -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Résultats de recherche</h5>
            <span class="badge bg-primary"><?= count($products) ?> produit(s) trouvé(s)</span>
        </div>
        <div class="card-body">
            <?php if (!empty($products) && count($products) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Propriétaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td>
                                <?php if (!empty($product['product_image'])): ?>
                                    <img src="<?= htmlspecialchars($product['product_image']) ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>" 
                                         width="60" height="60" class="rounded">
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= number_format($product['price'], 2, ',', ' ') ?> Ar</td>
                            <td><?= htmlspecialchars($product['category_name'] ?? '—') ?></td>
                            <td>
                                <span class="badge bg-info">
                                    <?= htmlspecialchars($product['owner_username'] ?? '—') ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>products/<?= $product['id'] ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> 
                    <?php if (!empty($keyword) || !empty($selectedCategoryId)): ?>
                        Aucun produit trouvé avec ces critères de recherche.
                    <?php else: ?>
                        Utilisez les critères de recherche ci-dessus pour trouver des produits.
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
