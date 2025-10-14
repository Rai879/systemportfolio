<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">FAQ Management</h2>
        <p class="mb-0">Kelola pertanyaan yang sering diajukan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/faq/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah FAQ
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
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($faqs) && !empty($faqs)): ?>
                        <?php foreach($faqs as $index => $faq): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $faq['question'] ?></td>
                                <td>
                                    <?php 
                                        $answer = strip_tags($faq['answer']);
                                        $words = explode(' ', $answer);
                                        if(count($words) > 10) {
                                            echo implode(' ', array_slice($words, 0, 10)) . '...';
                                        } else {
                                            echo $answer;
                                        }
                                    ?>
                                </td>
                                <td><?= $faq['sort_order'] ?></td>
                                <td>
                                    <?php if($faq['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/faq/edit/' . $faq['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/faq/toggle-status/' . $faq['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $faq['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $faq['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/faq/delete/' . $faq['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus FAQ ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada FAQ.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>