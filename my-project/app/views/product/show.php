<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <a href="<?= BASE_URL ?>products" class="btn btn-secondary mb-4">&larr; Retour à la liste</a>

    <?php if (!empty($product)): ?>
    <div class="card">
        <?php if (!empty($product['product_image'])): ?>
            <img src="<?= htmlspecialchars($product['product_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>" style="max-height: 400px; object-fit: cover;">
        <?php endif; ?>
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($product['name']) ?></h2>
            <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>ID :</strong> <?= htmlspecialchars($product['id']) ?></li>
                <li class="list-group-item"><strong>Prix :</strong> <?= number_format($product['price'], 2, ',', ' ') ?> €</li>
                <li class="list-group-item"><strong>Catégorie ID :</strong> <?= htmlspecialchars($product['category_id']) ?></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="<?= BASE_URL ?>products/edit/<?= $product['id'] ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= BASE_URL ?>products/delete/<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">Produit introuvable.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
