<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="<?= BASE_URL ?>css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border: 1px solid rgba(0,0,0,0.125);
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
        }
        .register-header {
            background-color: #0d6efd;
            padding: 2rem 1.5rem;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(0,0,0,0.125);
        }
        .register-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.75rem;
        }
        .register-body {
            padding: 2rem 1.5rem;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="register-header">
            <h3>Créer un compte</h3>
        </div>

        <div class="register-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= BASE_URL ?>user/register">
                <div class="mb-3">
                    <label class="form-label">Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" placeholder="Choisissez un nom d'utilisateur" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" placeholder="votre.email@exemple.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="phone" class="form-control" placeholder="0612345678" pattern="[0-9]{10}" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    <small class="text-muted">Format: 10 chiffres</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Choisissez un mot de passe" required minlength="6">
                    <small class="text-muted">Minimum 6 caractères</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" required minlength="6">
                </div>

                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </form>

            <div class="text-center mt-3">
                <span class="text-muted">Déjà un compte ?</span>
                <a href="<?= BASE_URL ?>" class="text-decoration-none fw-semibold">Se connecter</a>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
</body>
</html>
