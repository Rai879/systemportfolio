<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Statistics Management</h2>
        <p class="mb-0">Kelola statistik perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/statistics/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Statistic
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
                        <th>Label</th>
                        <th>Value</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($statistics) && !empty($statistics)): ?>
                        <?php foreach($statistics as $index => $statistic): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <div class="text-primary">
                                        <i class="bi <?= $statistic['icon'] ?> fs-4"></i>
                                    </div>
                                </td>
                                <td><?= $statistic['label'] ?></td>
                                <td>
                                    <span class="badge bg-primary fs-6"><?= $statistic['value'] ?>+</span>
                                </td>
                                <td><?= $statistic['sort_order'] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/statistics/edit/' . $statistic['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/statistics/delete/' . $statistic['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus statistic ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada statistics.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>