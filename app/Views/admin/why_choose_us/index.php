<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Why Choose Us Management</h2>
        <p class="mb-0">Kelola alasan memilih perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/why-choose-us/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Item
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($items) && !empty($items)): ?>
                        <?php foreach($items as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <div class="text-<?= $item['color'] ?>">
                                        <i class="bi <?= $item['icon'] ?> fs-4"></i>
                                    </div>
                                </td>
                                <td><?= $item['title'] ?></td>
                                <td><?= $item['description'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $item['color'] ?>"><?= $item['color'] ?></span>
                                </td>
                                <td><?= $item['sort_order'] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/why-choose-us/edit/' . $item['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/why-choose-us/delete/' . $item['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus item ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada items.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>