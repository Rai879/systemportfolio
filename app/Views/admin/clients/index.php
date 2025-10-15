<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Clients Management</h2>
        <p class="mb-0">Kelola daftar klien perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/clients/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Client
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
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($clients) && !empty($clients)): ?>
                        <?php foreach($clients as $index => $client): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if($client['logo']): ?>
                                        <img src="<?= base_url('uploads/clients/' . $client['logo']) ?>" 
                                             alt="<?= $client['name'] ?>" class="rounded" 
                                             style="width: 60px; height: 40px; object-fit: contain;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 40px;">
                                            <i class="bi bi-building text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $client['name'] ?></td>
                                <td><?= $client['location'] ?? '-' ?></td>
                                <td><?= $client['sort_order'] ?></td>
                                <td>
                                    <?php if($client['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/clients/edit/' . $client['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/clients/toggle-status/' . $client['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $client['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $client['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/clients/delete/' . $client['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus client ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada clients.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>