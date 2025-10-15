<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_site_settings('site_name') ?? 'Aplikasi Rumah Sakit' ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('icon/icon.png') ?>" alt="Logo">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        /* ------------------------------------------- */
        /* VARIABEL CSS untuk KUSTOMISASI MUDAH */
        /* ------------------------------------------- */
        :root {
            --navbar-height: 55px;
            /* <--- EDIT TINGGI NAVBAR DI SINI */
            --navbar-text-color: #333333;
            --navbar-hover-color: #0d6efd;
            /* Biru Bootstrap */
            --navbar-padding-x: 1.2rem;
        }

        /* Menggunakan font Poppins untuk seluruh body */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ------------------------------------------- */
        /* NAVBAR STYLES (Sesuai Gambar) */
        /* ------------------------------------------- */
        .navbar-custom {
            background-color: white !important;
            /* Warna putih */
            position: sticky;
            /* Posisi tetap */
            top: 0;
            z-index: 1020;
            box-shadow: 0 2px 20px rgba(0, 0, 0, .05);
            /* Sedikit shadow */
        }

        .navbar .container {
            /* Mengatur tinggi navbar */
            min-height: var(--navbar-height);
        }

        .navbar-brand {
            /* Menyesuaikan logo seperti gambar */
            font-weight: 600;
            color: var(--navbar-text-color) !important;
            font-size: 1.1rem;
        }

        .navbar-brand img {
            height: 24px;
            width: auto;
            margin-right: 8px;
        }

        .nav-link,
        .dropdown-toggle {
            color: var(--navbar-text-color) !important;
            font-weight: 500;
            padding-right: var(--navbar-padding-x) !important;
            padding-left: var(--navbar-padding-x) !important;
            transition: color 0.2s ease;
        }

        /* Warna teks saat hover/aktif */
        .nav-link:hover,
        .dropdown-toggle:hover,
        .nav-link.active {
            color: var(--navbar-hover-color) !important;
        }

        /* Dropdown menu */
        .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
            padding: 0.5rem 0;

            /* --- MODIFIKASI UNTUK HOVER & ANIMASI --- */
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            /* Mulai 10px di bawah */
            transition: opacity 0.5s ease, visibility 0.3s ease, transform 0.3s ease;
            pointer-events: none;
            margin-top: 0;
            /* --------------------------------------- */
        }

        /* Tampilkan dropdown saat nav-item di-hover (Memicu animasi slide-up) */
        .nav-item.dropdown:hover>.dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            /* Bergerak ke posisi akhir */
            pointer-events: auto;
        }

        .dropdown-item {
            color: var(--navbar-text-color);
            font-weight: 400;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
            /* Warna latar belakang saat hover */
            color: var(--navbar-hover-color);
        }
        .hero-section {
            background: #e6ecfa;
            color: #333;
            padding: 100px 0;
        }
        .section-padding {
            padding: 80px 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('icon/icon.png') ?>" style="height:32px; width:auto; margin-right:8px;"> <?= get_site_settings('site_name') ?? 'Aplikasi Rumah Sakit' ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPerusahaan" role="button" aria-expanded="false">
                            Perusahaan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPerusahaan">
                            <li><a class="dropdown-item" href="<?= base_url('/about') ?>">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/team') ?>">Tim Kami</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/services') ?>">Layanan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/products') ?>">Produk</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" role="button" aria-expanded="false">
                            Blog
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownBlog">
                            <li><a class="dropdown-item" href="<?= base_url('/blog') ?>">Semua Artikel</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/blog/kategori') ?>">Kategori</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/contact') ?>">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>