<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes produits</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/products.css">
</head>
<body>
    <h1>Produits de <?= htmlspecialchars($user['username']) ?></h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom du produit</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="<?= BASE_URL ?>images/<?= htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" class="product-img"></td>
                <td><?= htmlspecialchars($product['product_name']) ?></td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td><?= htmlspecialchars($product['category_name']) ?></td>
                <td><?= number_format($product['price'], 2, ',', ' ') ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
