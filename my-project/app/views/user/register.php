<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            animation: fadeInUp 0.6s ease;
            margin: 20px;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .register-header i {
            font-size: 3rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }
        .register-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        .register-body {
            padding: 35px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e0e6ed;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 2px solid #e0e6ed;
            border-right: none;
            background: #f8f9fa;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: #f0f3ff;
        }
        .input-group:focus-within .form-control {
            border-color: #667eea;
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s;
            color: white;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .btn-register:active {
            transform: translateY(0);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="register-header">
            <i class="bi bi-person-plus-fill"></i>
            <h3>Inscription</h3>
            <p class="mb-0 mt-2" style="opacity: 0.9;">Créez votre compte</p>
        </div>

        <div class="register-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($success) ?></div>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= BASE_URL ?>user/register">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nom d'utilisateur</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person-fill text-muted"></i>
                        </span>
                        <input type="text" name="username" class="form-control" placeholder="Choisissez un nom d'utilisateur" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Adresse email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill text-muted"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="votre.email@exemple.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-telephone-fill text-muted"></i>
                        </span>
                        <input type="tel" name="phone" class="form-control" placeholder="0612345678" pattern="[0-9]{10}" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    </div>
                    <small class="text-muted">Format: 10 chiffres</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill text-muted"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Choisissez un mot de passe" required minlength="6">
                    </div>
                    <small class="text-muted">Minimum 6 caractères</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirmer le mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill text-muted"></i>
                        </span>
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="btn btn-register w-100">
                    <i class="bi bi-person-check me-2"></i>S'inscrire
                </button>
            </form>

            <div class="text-center mt-3">
                <span class="text-muted">Déjà un compte ?</span>
                <a href="<?= BASE_URL ?>" class="text-decoration-none fw-semibold">Se connecter</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
