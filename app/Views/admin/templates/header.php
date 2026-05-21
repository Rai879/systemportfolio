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

        [v-cloak] {
            display: none !important;
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
    <div id="adminSidebarApp" v-cloak>
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
                <li class="nav-item" v-for="item in sidebarItems" :key="item.label">
                    <a class="nav-link" :href="item.href" :class="{ active: isActive(item) }" @click="closeMobileSidebar">
                        <i :class="item.icon"></i> {{ item.label }}
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
                    <li class="nav-item" v-for="item in sidebarItems" :key="item.label">
                        <a class="nav-link" :href="item.href" :class="{ active: isActive(item) }" @click="closeMobileSidebar">
                            <i :class="item.icon"></i> {{ item.label }}
                        </a>
                    </li>
                </ul>
            </div>
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
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        const adminSidebarApp = Vue.createApp({
            data() {
                return {
                    currentPath: '<?= parse_url(current_url(), PHP_URL_PATH) ?>',
                    sidebarItems: [
                        { label: 'Dashboard', href: '<?= base_url('/admin/dashboard') ?>', icon: 'bi bi-speedometer2', exact: true },
                        { label: 'Manajemen User', href: '<?= base_url('/admin/users') ?>', icon: 'bi bi-people' },
                        { label: 'About Company', href: '<?= base_url('/admin/about-company') ?>', icon: 'bi bi-building' },
                        { label: 'Halaman Dinamis', href: '<?= base_url('/admin/pages') ?>', icon: 'bi bi-file-earmark-text' },
                        { label: 'Pengaturan Situs', href: '<?= base_url('/admin/settings') ?>', icon: 'bi bi-gear' },
                        { label: 'Hero Slides', href: '<?= base_url('/admin/hero-slides') ?>', icon: 'bi bi-images' },
                        { label: 'Features', href: '<?= base_url('/admin/features') ?>', icon: 'bi bi-star' },
                        { label: 'Blog Posts', href: '<?= base_url('/admin/blog-posts') ?>', icon: 'bi bi-journal-text' },
                        { label: 'FAQ', href: '<?= base_url('/admin/faq') ?>', icon: 'bi bi-question-circle' },
                        { label: 'Work Scope', href: '<?= base_url('/admin/work-scope') ?>', icon: 'bi bi-people' },
                        { label: 'Why Choose Us', href: '<?= base_url('/admin/why-choose-us') ?>', icon: 'bi bi-building' },
                        { label: 'Clients', href: '<?= base_url('/admin/clients') ?>', icon: 'bi bi-building' },
                        { label: 'Products', href: '<?= base_url('/admin/products') ?>', icon: 'bi bi-box' },
                        { label: 'Team Members', href: '<?= base_url('/admin/team-members') ?>', icon: 'bi bi-person-badge' },
                        { label: 'Statistics', href: '<?= base_url('/admin/statistics') ?>', icon: 'bi bi-graph-up' },
                        { label: 'Logout', href: '<?= base_url('/admin/logout') ?>', icon: 'bi bi-box-arrow-left', exact: true }
                    ]
                };
            },
            methods: {
                normalizePath(path) {
                    const normalized = new URL(path, window.location.origin).pathname;
                    return normalized.replace(/\/$/, '') || '/';
                },
                isActive(item) {
                    const itemPath = this.normalizePath(item.href);
                    const current = this.normalizePath(this.currentPath);
                    return item.exact ? current === itemPath : current.startsWith(itemPath);
                },
                closeMobileSidebar() {
                    const offcanvasElement = document.getElementById('mobileSidebar');
                    if (offcanvasElement) {
                        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                        if (offcanvas) offcanvas.hide();
                    }
                }
            }
        });
        
        const adminAppInstance = adminSidebarApp.mount('#adminSidebarApp');

        // Vanilla SPA Script (Tanpa Turbo, mengganti main-content via fetch)
        function initAdminScripts() {
            // Re-init DataTable
            if ($.fn.DataTable.isDataTable('.data-table')) {
                $('.data-table').DataTable().destroy();
            }
            $('.data-table').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' }
            });
        }

        async function fetchAndReplace(url, options = {}) {
            try {
                // Tampilkan loading state sederhana di kursor
                document.body.style.cursor = 'wait';
                
                const response = await fetch(url, options);
                if (!response.ok && response.status !== 400 && response.status !== 422) {
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }
                }

                // If it's a logout redirect or similar
                if (response.redirected && response.url.includes('/login')) {
                    window.location.href = response.url;
                    return;
                }

                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Update Title & Main Content
                document.title = doc.title;
                const newContent = doc.querySelector('.main-content');
                if (newContent) {
                    document.querySelector('.main-content').innerHTML = newContent.innerHTML;
                } else {
                    // Fallback jika respons tidak memiliki .main-content
                    window.location.href = url;
                    return;
                }

                // Push history jika GET
                if ((!options.method || options.method === 'GET') && window.location.href !== url) {
                    window.history.pushState(null, '', url);
                }

                // Update currentPath di Vue sidebar
                adminAppInstance.currentPath = window.location.pathname;

                // Re-init
                initAdminScripts();
            } catch (e) {
                console.error('SPA Error:', e);
                window.location.href = url; // Fallback ke normal load
            } finally {
                document.body.style.cursor = 'default';
            }
        }

        // Intercept all link clicks
        document.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (!link || !link.href) return;
            if (link.target === '_blank' || link.hasAttribute('download')) return;
            if (link.href.includes('/admin/logout')) return; // Biarkan logout normal
            
            // Pastikan URL internal admin
            const currentHost = window.location.origin;
            if (link.href.startsWith(currentHost) && link.href.includes('/admin')) {
                e.preventDefault();
                // Close offcanvas jika di mobile
                const offcanvasElement = document.getElementById('mobileSidebar');
                if (offcanvasElement) {
                    const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                    if (offcanvas) offcanvas.hide();
                }
                
                fetchAndReplace(link.href);
            }
        });

        // Intercept form submissions
        document.addEventListener('submit', e => {
            const form = e.target;
            if (form.tagName === 'FORM' && form.closest('.main-content')) {
                e.preventDefault();
                const formData = new FormData(form);
                const action = form.action || window.location.href;
                const method = form.method || 'POST';
                
                fetchAndReplace(action, {
                    method: method.toUpperCase(),
                    body: method.toUpperCase() === 'POST' ? formData : null
                });
            }
        });

        // Handle back/forward buttons
        window.addEventListener('popstate', () => {
            fetchAndReplace(window.location.href);
        });

        // Initial setup
        document.addEventListener('DOMContentLoaded', initAdminScripts);
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>