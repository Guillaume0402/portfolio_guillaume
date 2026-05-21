<!doctype html>
<html lang="fr">

<head>
    <?php
    $siteName = 'Guillaume Maignaut';

    $pageTitle = $pageTitle ?? 'Guillaume Maignaut | Développeur Web Freelance PHP';

    $pageDescription = $pageDescription ?? 'Développeur web freelance spécialisé en PHP, JavaScript et création de sites vitrines modernes, rapides et responsives.';

    $pageCanonical = $pageCanonical ?? 'https://guillaumemaignaut.com/';

    $pageImage = $pageImage ?? 'https://guillaumemaignaut.com/assets/images/preview.webp';

    $pageImageAlt = $pageImageAlt ?? 'Aperçu du portfolio de Guillaume Maignaut, développeur web freelance';

    $assetVersion = static function (string $path): string {
        $absolutePath = dirname(__DIR__, 3) . '/public' . $path;

        return is_file($absolutePath) ? (string) filemtime($absolutePath) : '1';
    };
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <meta
        name="description"
        content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">

    <meta property="og:site_name" content="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="<?= htmlspecialchars($pageImage, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image:width" content="1120">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= htmlspecialchars($pageImageAlt, ENT_QUOTES, 'UTF-8') ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($pageImage, ENT_QUOTES, 'UTF-8') ?>">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/webp" href="/favicon.webp">
    <link rel="stylesheet" href="/assets/app.css?v=<?= $assetVersion('/assets/app.css') ?>">
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

    <script type="module" src="/js/main.js?v=<?= $assetVersion('/js/main.js') ?>"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
