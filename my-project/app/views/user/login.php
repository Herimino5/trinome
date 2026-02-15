<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Utilisateur</title>
    <link href="<?= BASE_URL ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>public/css/products.css" rel="stylesheet">
    <!-- Bootstrap Icons offline option: <link href="<?= BASE_URL ?>public/css/bootstrap-icons.css" rel="stylesheet"> -->
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border: 1px solid rgba(0,0,0,0.125);
            max-width: 420px;
            width: 100%;
        }
        .login-header {
            background-color: #0d6efd;
            padding: 2rem 1.5rem;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(0,0,0,0.125);
        }
        .login-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.75rem;
        }
        .login-body {
            padding: 2rem 1.5rem;
        }
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #dee2e6;
        }
        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: #6c757d;
        }
        .home-link {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h3>Connexion Utilisateur</h3>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= BASE_URL ?>user/login">
                <div class="mb-3">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" placeholder="votre.email@exemple.com" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>

            <div class="text-center mt-3">
                <span class="text-muted">Pas encore de compte ?</span>
                <a href="<?= BASE_URL ?>user/register" class="text-decoration-none fw-semibold">S'inscrire</a>
            </div>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="home-link">
                <a href="<?= BASE_URL ?>admin" class="btn btn-secondary">Accès administrateur</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>public/js/bootstrap.bundle.min.js"></script>
</body>
</html>