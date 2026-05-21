<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-gray-800">Dashboard</h2>
</div>

<!-- Stats Row -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalUsers'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card success h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Clients</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalClients'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card warning h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Blog Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalBlogPosts'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-journal-text fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card danger h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Active Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalProducts'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Posts Row -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Latest Blog Posts</h6>
                <a href="<?= base_url('/admin/blog-posts') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($latestPosts)): ?>
                            <tr>
                                <td colspan="3" class="text-center">No posts found.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach($latestPosts as $post): ?>
                                <tr>
                                    <td><?= esc($post['title']) ?></td>
                                    <td>
                                        <span class="badge <?= $post['is_published'] ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $post['is_published'] ? 'Published' : 'Draft' ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
