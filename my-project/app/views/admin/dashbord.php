<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Admin</title>
	<link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
	<style>
		body {
			background: linear-gradient(135deg, #0f172a 0%, #1f2937 100%);
			min-height: 100vh;
			color: #e5e7eb;
		}
		.dashboard-card {
			background: #111827;
			border: 1px solid #1f2937;
			border-radius: 16px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}
		.dashboard-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 24px 50px rgba(0, 0, 0, 0.35);
		}
		.card-icon {
			width: 52px;
			height: 52px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 12px;
			background: #1f2937;
			color: #93c5fd;
			font-size: 1.6rem;
		}
		.btn-cta {
			background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
			border: none;
			color: #fff;
			font-weight: 600;
		}
		.btn-cta:hover {
			filter: brightness(1.05);
		}
	</style>
</head>
<body>
	<div class="container py-5">
		<div class="mb-4">
			<h1 class="fw-bold mb-1">Dashboard Admin</h1>
			<?php if (!empty($message)): ?>
				<p class="text-secondary"><?= htmlspecialchars($message) ?></p>
			<?php endif; ?>
		</div>

		<div class="row g-4">
			<div class="col-md-6">
				<div class="dashboard-card p-4 h-100">
					<div class="d-flex align-items-center gap-3 mb-3">
						<span class="card-icon">#</span>
						<h3 class="h5 mb-0">Gerer les categories (CRUD)</h3>
					</div>
					<p class="text-secondary">Ajouter, modifier ou supprimer les categories de produits.</p>
					<a class="btn btn-cta w-100" href="<?= BASE_URL ?>admin/categories">
						Ouvrir la gestion des categories
					</a>
				</div>
			</div>

			<div class="col-md-6">
				<div class="dashboard-card p-4 h-100">
					<div class="d-flex align-items-center gap-3 mb-3">
						<span class="card-icon">%</span>
						<h3 class="h5 mb-0">Statistiques</h3>
					</div>
					<p class="text-secondary">Voir le nombre d echange effectues et le nombre d utilisateurs.</p>
					<a class="btn btn-cta w-100" href="<?= BASE_URL ?>admin/statistiques">
						Voir les statistiques
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
