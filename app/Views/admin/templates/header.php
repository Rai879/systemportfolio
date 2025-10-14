<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Sanata Medical</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: white;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover {
            background: #34495e;
        }
        .sidebar .nav-link.active {
            background: #3498db;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <a href="<?= base_url('/admin/dashboard') ?>" class="navbar-brand text-white d-block text-center mb-3">
                        <i class="bi bi-hospital"></i> Sanata Medical
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= current_url() == base_url('/admin/dashboard') ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/dashboard') ?>">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/users') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/users') ?>">
                                <i class="bi bi-people me-2"></i> Manajemen User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/settings') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/settings') ?>">
                                <i class="bi bi-gear me-2"></i> Pengaturan Situs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/about-company') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/about-company') ?>">
                                <i class="bi bi-building me-2"></i> About Company
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/hero-slides') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/hero-slides') ?>">
                                <i class="bi bi-images me-2"></i> Hero Slides
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/features') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/features') ?>">
                                <i class="bi bi-star me-2"></i> Features
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/blog-posts') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/blog-posts') ?>">
                                <i class="bi bi-journal-text me-2"></i> Blog Posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/faq') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/faq') ?>">
                                <i class="bi bi-question-circle me-2"></i> FAQ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/clients') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/clients') ?>">
                                <i class="bi bi-building me-2"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/products') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/products') ?>">
                                <i class="bi bi-box me-2"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/team-members') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/team-members') ?>">
                                <i class="bi bi-person-badge me-2"></i> Team Members
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/admin/statistics') !== false ? 'active' : '' ?>" 
                               href="<?= base_url('/admin/statistics') ?>">
                                <i class="bi bi-graph-up me-2"></i> Statistics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/admin/logout') ?>">
                                <i class="bi bi-box-arrow-left me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content p-0">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        <button class="btn btn-sm btn-outline-secondary" id="sidebarToggle">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="navbar-nav ms-auto">
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i> 
                                    <?= session()->get('username') ?? 'Admin' ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('/admin/profile') ?>"><i class="bi bi-person me-2"></i> Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('/admin/logout') ?>"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="p-4">
                    <!-- Flash Messages -->
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Content will be inserted here -->
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('col-md-3');
            document.querySelector('.sidebar').classList.toggle('col-lg-2');
            document.querySelector('.sidebar').classList.toggle('d-none');
            document.querySelector('.main-content').classList.toggle('col-md-9');
            document.querySelector('.main-content').classList.toggle('col-lg-10');
            document.querySelector('.main-content').classList.toggle('col-12');
        });

        // Initialize DataTables
        $(document).ready(function() {
            $('.data-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>