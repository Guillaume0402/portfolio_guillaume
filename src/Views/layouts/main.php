<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'App') ?></title>
    <link rel="stylesheet" href="/assets/app.css">
</head>
<body>

<?php
require __DIR__ . '/../partials/header.php';
?>

<main class="app-container">
  <?= $content ?? '' ?>
</main>

<?php
require __DIR__ . '/../partials/footer.php';
?>

<script type="module" src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
