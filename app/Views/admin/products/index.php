<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Products Management</h2>
        <p class="mb-0">Kelola produk dan layanan perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/products/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Product
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
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($products) && !empty($products)): ?>
                        <?php foreach($products as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if($product['image']): ?>
                                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                             alt="<?= $product['name'] ?>" class="rounded" 
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 40px;">
                                            <i class="bi bi-box text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $product['name'] ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?= $product['category'] ?></span>
                                </td>
                                <td><?=$product['description']?></td>
                                <td><?= $product['sort_order'] ?></td>
                                <td>
                                    <?php if($product['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/products/edit/' . $product['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/products/toggle-status/' . $product['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $product['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $product['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/products/delete/' . $product['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus product ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada products.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>