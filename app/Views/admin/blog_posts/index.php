<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Blog Posts Management</h2>
        <p class="mb-0">Kelola artikel dan berita perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/blog-posts/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Post
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($blogPosts) && !empty($blogPosts)): ?>
                        <?php foreach($blogPosts as $index => $post): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if($post['featured_image']): ?>
                                        <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" 
                                             alt="<?= $post['title'] ?>" class="rounded" 
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 40px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= $post['title'] ?></div>
                                    <small class="text-muted"><?= $post['slug'] ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?= $post['category'] ?></span>
                                </td>
                                <td><?= $post['author'] ?></td>
                                <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                                <td>
                                    <?php if($post['is_published']): ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/blog/' . $post['slug']) ?>" 
                                           target="_blank" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/blog-posts/edit/' . $post['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/blog-posts/toggle-publish/' . $post['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $post['is_published'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $post['is_published'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/blog-posts/delete/' . $post['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus post ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada blog posts.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>