<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Hero Slides Management</h2>
        <p class="mb-0">Kelola slides untuk bagian hero website</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/hero-slides/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Slide
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
                        <th>Subjudul</th>
                        <th>Tombol</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($slides) && !empty($slides)): ?>
                        <?php foreach($slides as $index => $slide): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if($slide['image']): ?>
                                        <img src="<?= base_url('uploads/hero/' . $slide['image']) ?>" 
                                             alt="<?= $slide['title'] ?>" class="rounded" 
                                             style="width: 80px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 50px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= $slide['title'] ?></div>
                                    <small class="text-muted"><?= $slide['description'] ?></small>
                                </td>
                                <td><?= $slide['subtitle'] ?? '-' ?></td>
                                <td>
                                    <?php if($slide['button_text']): ?>
                                        <span class="badge bg-primary"><?= $slide['button_text'] ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No Button</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $slide['sort_order'] ?></td>
                                <td>
                                    <?php if($slide['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/hero-slides/edit/' . $slide['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/hero-slides/toggle-status/' . $slide['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $slide['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $slide['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/hero-slides/delete/' . $slide['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus slide ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada hero slides.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>