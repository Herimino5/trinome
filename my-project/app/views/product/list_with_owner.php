<?php $title = 'Tous les produits avec leur propriétaire'; include __DIR__ . '/../layout/header.php'; ?>
<h1 class="mb-4">Tous les produits avec leur propriétaire</h1>
<div class="row g-3">
    <?php foreach ($products as $product): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a href="<?= BASE_URL ?>products/<?= $product['product_id'] ?>" class="text-decoration-none text-dark">
        <div class="card product-card h-100 shadow-sm border-0" style="min-width:220px;max-width:320px;cursor:pointer;">
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($product['product_image']) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($product['product_name']) ?>" style="height:120px;object-fit:cover;">
            <div class="card-body p-2">
                <h6 class="card-title mb-1 text-truncate" title="<?= htmlspecialchars($product['product_name']) ?>"><?= htmlspecialchars($product['product_name']) ?></h6>
                <div class="mb-1 text-muted small">Catégorie : <?= htmlspecialchars($product['category_name']) ?></div>
                <div class="card-text mb-1 small text-truncate" title="<?= htmlspecialchars($product['description']) ?>" style="min-height:32px;max-height:32px;overflow:hidden;">
                    <?= htmlspecialchars($product['description']) ?>
                </div>
                <div class="fw-bold mb-1" style="color:#4a4a7c;font-size:1rem;">Prix : <?= number_format($product['price'], 2, ',', ' ') ?> €</div>
                <div class="owner-box p-1 rounded bg-light small">
                    <i class="bi bi-person-circle"></i> <span class="fw-semibold">Propriétaire :</span> <?= htmlspecialchars($product['owner_name']) ?><br>
                    <i class="bi bi-envelope"></i> <?= htmlspecialchars($product['email']) ?><br>
                    <i class="bi bi-telephone"></i> <?= htmlspecialchars($product['phone']) ?>
                </div>
                <div class="mt-2">
                    <a class="btn btn-sm btn-outline-primary w-100" href="<?= BASE_URL ?>products/history/<?= $product['product_id'] ?>">Voir l historique</a>
                </div>
            </div>
        </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item<?= $i == $page ? ' active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>">Page <?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
