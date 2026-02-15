<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Echange de Produits</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container-main {
            max-width: 450px;
            width: 100%;
        }
        .login-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border: 1px solid rgba(0,0,0,0.125);
        }
        .login-header {
            background-color: #0d6efd;
            padding: 2rem 1.5rem;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(0,0,0,0.125);
        }
        .login-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.75rem;
        }
        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
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
        .links-section {
            display: flex;
            gap: 0.75rem;
            flex-direction: column;
        }
    </style>
</head>
<body>

<div class="container-main">
    <div class="login-card">
        <div class="login-header">
            <h2>Takalo Takalo</h2>
            <p>Connexion Utilisateur</p>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
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

            <div class="divider">
                <span>Options</span>
            </div>

            <div class="links-section">
                <a href="<?= BASE_URL ?>user/register" class="btn btn-success w-100">Créer un compte</a>
                <a href="<?= BASE_URL ?>admin" class="btn btn-secondary w-100">Accès Admin</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>