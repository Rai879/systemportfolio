<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Halaman Dinamis</h2>
        <p class="mb-0">Kelola konten halaman seperti Privacy Policy dan Terms of Service</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Halaman</th>
                        <th>Slug / URL</th>
                        <th>Terakhir Diubah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($pages)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada halaman dinamis.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($pages as $index => $page): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($page['title']) ?></td>
                                <td><code>/<?= esc($page['slug']) ?></code></td>
                                <td><?= date('d M Y H:i', strtotime($page['updated_at'] ?? $page['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('/admin/pages/edit/' . $page['id']) ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit Konten
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
