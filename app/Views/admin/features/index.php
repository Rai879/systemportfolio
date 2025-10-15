<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Features Management</h2>
        <p class="mb-0">Kelola fitur-fitur unggulan perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/features/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Feature
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
                        <th>Icon</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Warna</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($features) && !empty($features)): ?>
                        <?php foreach($features as $index => $feature): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <div class="text-<?= $feature['color'] ?>">
                                        <i class="bi <?= $feature['icon'] ?> fs-4"></i>
                                    </div>
                                </td>
                                <td><?= $feature['title'] ?></td>
                                <td><?= $feature['description'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $feature['color'] ?>"><?= $feature['color'] ?></span>
                                </td>
                                <td><?= $feature['sort_order'] ?></td>
                                <td>
                                    <?php if($feature['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/features/edit/' . $feature['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/features/toggle-status/' . $feature['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $feature['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $feature['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/features/delete/' . $feature['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus feature ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada features.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>