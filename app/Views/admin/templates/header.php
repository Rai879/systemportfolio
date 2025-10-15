<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_site_settings('site_name') ?? 'Aplikasi Rumah Sakit' ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('icon/icon.png') ?>" alt="Logo">


    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* Desktop Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #2c3e50;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #34495e;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #3498db;
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand img {
            height: 32px;
            width: auto;
            margin-right: 8px;
        }

        .sidebar .nav {
            padding: 15px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 15px;
            margin: 5px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: #34495e;
            padding-left: 20px;
        }

        .sidebar .nav-link.active {
            background: #3498db;
        }

        .sidebar .nav-link i {
            min-width: 20px;
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .content-wrapper {
            padding: 20px;
        }

        /* Top Bar for Mobile */
        .mobile-top-bar {
            display: none;
            background: white;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .mobile-menu-btn {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        .mobile-user-info {
            display: flex;
            align-items: center;
            color: #2c3e50;
            font-weight: 500;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stat-card {
            border-left: 4px solid #3498db;
        }

        .stat-card.success {
            border-left-color: #2ecc71;
        }

        .stat-card.warning {
            border-left-color: #f39c12;
        }

        .stat-card.danger {
            border-left-color: #e74c3c;
        }

        /* Offcanvas untuk Mobile */
        .offcanvas {
            background: #2c3e50;
            color: white;
            width: 280px !important;
        }

        .offcanvas-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .offcanvas-title {
            color: white;
        }

        .btn-close {
            filter: invert(1);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-top-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }

        /* Alert Styling */
        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Mobile Top Bar -->
    <div class="mobile-top-bar d-lg-none">
        <button class="mobile-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="bi bi-list"></i>
        </button>
        <div class="mobile-user-info">
            <i class="bi bi-person-circle me-2"></i>
            <?= session()->get('username') ?? 'Admin' ?>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <aside class="sidebar d-none d-lg-block">
        <div class="sidebar-header">
            <a href="<?= base_url('/admin/dashboard') ?>" class="sidebar-brand">
                <img src="<?= base_url('icon/icon.png') ?>" alt="Logo">
                <span><?= get_site_settings('site_name') ?? 'Aplikasi Rumah Sakit' ?></span>
            </a>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <?php
                // Get the relevant path for comparison
                $currentPath = parse_url(current_url(), PHP_URL_PATH);
                $dashboardPath = base_url('/admin/dashboard', true); // Ensure we get the full path
                $isActive = $currentPath === $dashboardPath || strpos($currentPath, '/admin/dashboard') !== false;
                ?>
                <a class="nav-link <?= $isActive ? 'active' : '' ?>" href="<?= base_url('/admin/dashboard') ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/users') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/users') ?>">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/settings') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/settings') ?>">
                    <i class="bi bi-gear"></i> Pengaturan Situs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/about-company') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/about-company') ?>">
                    <i class="bi bi-building"></i> About Company
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/hero-slides') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/hero-slides') ?>">
                    <i class="bi bi-images"></i> Hero Slides
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/features') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/features') ?>">
                    <i class="bi bi-star"></i> Features
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/blog-posts') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/blog-posts') ?>">
                    <i class="bi bi-journal-text"></i> Blog Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/faq') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/faq') ?>">
                    <i class="bi bi-question-circle"></i> FAQ
                </a>
            </li>
            <li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/work-scope') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/work-scope') ?>">
                        <i class="bi bi-people"></i> Work Scope
                    </a>
                </li>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/why-choose-us') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/why-choose-us') ?>">
                    <i class="bi bi-building"></i> Why Choose Us
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/clients') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/clients') ?>">
                    <i class="bi bi-building"></i> Clients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/products') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/products') ?>">
                    <i class="bi bi-box"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/team-members') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/team-members') ?>">
                    <i class="bi bi-person-badge"></i> Team Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), '/admin/statistics') !== false ? 'active' : '' ?>"
                    href="<?= base_url('/admin/statistics') ?>">
                    <i class="bi bi-graph-up"></i> Statistics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/admin/logout') ?>">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </aside>

    <!-- Mobile Sidebar (Offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">
                <img src="<?= base_url('icon/icon.png') ?>" alt="Logo" style="height: 28px; margin-right: 8px;">
                <?= $siteSettings['site_name'] ?? 'Aplikasi Rumah Sakit' ?>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column" style="padding: 15px;">
                <li class="nav-item">
                    <a class="nav-link <?= current_url() == base_url('/admin/dashboard') ? 'active' : '' ?>"
                        href="<?= base_url('/admin/dashboard') ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/users') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/users') ?>">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/settings') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/settings') ?>">
                        <i class="bi bi-gear"></i> Pengaturan Situs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/about-company') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/about-company') ?>">
                        <i class="bi bi-building"></i> About Company
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/hero-slides') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/hero-slides') ?>">
                        <i class="bi bi-images"></i> Hero Slides
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/features') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/features') ?>">
                        <i class="bi bi-star"></i> Features
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/blog-posts') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/blog-posts') ?>">
                        <i class="bi bi-journal-text"></i> Blog Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/faq') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/faq') ?>">
                        <i class="bi bi-question-circle"></i> FAQ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/clients') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/clients') ?>">
                        <i class="bi bi-building"></i> Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/products') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/products') ?>">
                        <i class="bi bi-box"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/team-members') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/team-members') ?>">
                        <i class="bi bi-person-badge"></i> Team Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos(current_url(), '/admin/statistics') !== false ? 'active' : '' ?>"
                        href="<?= base_url('/admin/statistics') ?>">
                        <i class="bi bi-graph-up"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/admin/logout') ?>">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Content Section -->
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Initialize DataTables
        $(document).ready(function () {
            $('.data-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });

        // Auto close offcanvas when link is clicked
        document.querySelectorAll('#mobileSidebar .nav-link').forEach(link => {
            link.addEventListener('click', function () {
                const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileSidebar'));
                if (offcanvas) {
                    offcanvas.hide();
                }
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>