<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Dashboard</h2>
        <p class="mb-0">Selamat datang di Admin Panel Sanata Medical Suite</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title text-muted mb-0">Total Blog Posts</h5>
                        <span class="h4 font-weight-bold mb-0"><?= $totalBlogPosts ?? 0 ?></span>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-journal-text text-primary fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card stat-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title text-muted mb-0">Total Clients</h5>
                        <span class="h4 font-weight-bold mb-0"><?= $totalClients ?? 0 ?></span>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-building text-success fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card stat-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title text-muted mb-0">Total Products</h5>
                        <span class="h4 font-weight-bold mb-0"><?= $totalProducts ?? 0 ?></span>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-box text-warning fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="card stat-card danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title text-muted mb-0">Total Users</h5>
                        <span class="h4 font-weight-bold mb-0"><?= $totalUsers ?? 0 ?></span>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-people text-danger fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Blog Posts -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Blog Posts Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if(isset($latestPosts) && !empty($latestPosts)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($latestPosts as $post): ?>
                                    <tr>
                                        <td><?= $post['title'] ?></td>
                                        <td><span class="badge bg-secondary"><?= $post['category'] ?></span></td>
                                        <td><?= $post['author'] ?></td>
                                        <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                                        <td>
                                            <?php if($post['is_published']): ?>
                                                <span class="badge bg-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-3">Belum ada blog posts.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('/admin/blog-posts/create') ?>" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Blog Post
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-success w-100">
                            <i class="bi bi-person-plus me-2"></i> Tambah User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('/admin/settings') ?>" class="btn btn-info w-100">
                            <i class="bi bi-gear me-2"></i> Pengaturan Situs
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('/admin/hero-slides/create') ?>" class="btn btn-warning w-100">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Hero Slide
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>