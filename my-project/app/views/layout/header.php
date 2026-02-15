<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Application' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/products.css">
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>public/css/bootstrap-icons.css"> -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-left:220px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL ?>products">Accueil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>exchange/received"><i class="bi bi-arrow-left-right"></i> Propositions d'échange</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>user/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php include __DIR__ . '/../product/sidebar.php'; ?>
<div class="main-content">
<!-- JS Bootstrap offline -->
<script src="<?= BASE_URL ?>js/bootstrap.bundle.min.js"></script>
