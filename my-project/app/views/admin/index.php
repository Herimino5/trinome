<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
</head>
<body>

<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <form method="post" action="<?= BASE_URL ?>admin/login" class="p-4 border rounded" style="width:350px;">
        <h4 class="text-center mb-3">Admin Login</h4>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Admin name</label>
            <input type="text" name="adminname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>

</body>
</html>
