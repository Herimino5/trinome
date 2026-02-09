<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($product) ? 'Modifier le Produit' : 'Nouveau Produit' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <a href="<?= BASE_URL ?>products" class="btn btn-secondary mb-4">&larr; Retour à la liste</a>

    <div class="card">
        <div class="card-header">
            <h2><?= isset($product) ? 'Modifier le Produit' : 'Créer un Produit' ?></h2>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= isset($product) ? BASE_URL . 'products/update/' . $product['id'] : BASE_URL . 'products/create' ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix (€)</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="<?= htmlspecialchars($product['price'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($product) && $product['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="product_image" class="form-label">URL de l'image</label>
                    <input type="text" class="form-control" id="product_image" name="product_image" value="<?= htmlspecialchars($product['product_image'] ?? '') ?>" placeholder="https://exemple.com/image.jpg">
                </div>

                <button type="submit" class="btn btn-primary">
                    <?= isset($product) ? 'Mettre à jour' : 'Créer' ?>
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
