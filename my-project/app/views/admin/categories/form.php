<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($category) ? 'Modifier la categorie' : 'Nouvelle categorie' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <a class="btn btn-outline-secondary mb-3" href="<?= BASE_URL ?>admin/categories">&larr; Retour a la liste</a>

        <div class="card">
            <div class="card-header">
                <h1 class="h4 mb-0"><?= isset($category) ? 'Modifier la categorie' : 'Creer une categorie' ?></h1>
            </div>
            <div class="card-body">
                <form method="post" action="<?= isset($category) ? BASE_URL . 'admin/categories/update/' . $category['id'] : BASE_URL . 'admin/categories/create' ?>">
                    <div class="mb-3">
                        <label class="form-label" for="name">Nom</label>
                        <input class="form-control" id="name" name="name" type="text" value="<?= htmlspecialchars($category['name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image">URL image</label>
                        <input class="form-control" id="image" name="image" type="text" value="<?= htmlspecialchars($category['image_'] ?? '') ?>" placeholder="https://exemple.com/image.jpg">
                    </div>

                    <button class="btn btn-primary" type="submit">
                        <?= isset($category) ? 'Mettre a jour' : 'Creer' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>
