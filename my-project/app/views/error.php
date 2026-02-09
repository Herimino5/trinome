<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erreur</h4>
        <p><?= htmlspecialchars($message ?? 'Une erreur inattendue est survenue.') ?></p>
        <hr>
        <a href="<?= BASE_URL ?>products" class="btn btn-primary">Retour à la liste des produits</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
