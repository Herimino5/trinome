<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Categories</h1>
            <a class="btn btn-primary" href="<?= BASE_URL ?>admin/categories/create">+ Nouvelle categorie</a>
        </div>

        <?php if (!empty($categories)): ?>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['id']) ?></td>
                            <td><?= htmlspecialchars($category['name']) ?></td>
                            <td><?= htmlspecialchars($category['description'] ?? '') ?></td>
                            <td>
                                <?php if (!empty($category['image_'])): ?>
                                    <a href="<?= htmlspecialchars($category['image_']) ?>" target="_blank">Voir</a>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="<?= BASE_URL ?>admin/categories/edit/<?= $category['id'] ?>">Modifier</a>
                                <a class="btn btn-sm btn-danger" href="<?= BASE_URL ?>admin/categories/delete/<?= $category['id'] ?>" onclick="return confirm('Supprimer cette categorie ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Aucune categorie trouvee.</div>
        <?php endif; ?>

        <a class="btn btn-outline-secondary mt-3" href="<?= BASE_URL ?>admin/dashbord">Retour au dashboard</a>
    </div>

    <script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>
