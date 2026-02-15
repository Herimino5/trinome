<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Statistiques</h1>
            <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>admin/dashbord">Retour au dashboard</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Echanges effectues</h2>
                        <p class="display-6 mb-0"><?= htmlspecialchars($exchangeCount ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Utilisateurs</h2>
                        <p class="display-6 mb-0"><?= htmlspecialchars($userCount ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>
