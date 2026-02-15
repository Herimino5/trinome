<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <link href="<?= BASE_URL ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/products.css" rel="stylesheet">
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
            <div class="d-flex gap-2 mb-3">
                <a href="<?= BASE_URL ?>products/edit/<?= $product['id'] ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= BASE_URL ?>products/delete/<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
            </div>
            <form method="post" action="<?= BASE_URL ?>exchange/propose">
                <input type="hidden" name="desiredproduct_id" value="<?= $product['id'] ?>">
                <div class="mb-2">
                    <label for="myproduct_id" class="form-label">Choisir un de vos produits à échanger :</label>
                    <select name="myproduct_id" id="myproduct_id" class="form-select" required>
                        <?php foreach ($myProducts as $mp): ?>
                            <option value="<?= $mp['id'] ?>"><?= htmlspecialchars($mp['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Proposer un échange</button>
            </form>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">Produit introuvable.</div>
    <?php endif; ?>
</div>

<script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>
