<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($siteSettings['site_name'] ?? 'System879 SPA') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('icon/icon.png') ?>" />

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (Required for legacy views) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- AOS CSS for Animations (Legacy) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Vite built CSS will be injected by Vite -->
    <?php if (file_exists(FCPATH . 'dist/assets/app.css')): ?>
        <link rel="stylesheet" href="<?= base_url('dist/assets/app.css') ?>">
    <?php endif; ?>
    
    <!-- Dev Mode Vite (if needed) handled in index.php usually, but let's assume built for now, or Vite dev server -->
</head>

<body>
    <div id="app"></div>

    <script>
        window.__SITE_SETTINGS__ = <?= json_encode(array_merge($siteSettings, ['logo_url' => base_url('icon/icon.png')]), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
        window.__BASE_URL__ = '<?= base_url() ?>';
    </script>
    <script type="module" src="<?= base_url('dist/assets/app.js') ?>"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>
