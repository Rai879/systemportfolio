<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $siteSettings['site_name'] ?? 'Sanata Medical Suite' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .section-padding {
            padding: 80px 0;
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0 20px;
        }
        .blog-card {
            transition: transform 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="icon/icon.png" alt="" style="height:32px; width:auto; margin-right:8px;"> <?= $siteSettings['site_name'] ?? 'Sanata Medical Suite' ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/about') ?>">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/services') ?>">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/products') ?>">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/blog') ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/contact') ?>">Kontak</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a href="<?= base_url('/admin/login') ?>" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-lock"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>