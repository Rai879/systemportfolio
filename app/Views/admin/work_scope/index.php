<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Work Scope Management</h2>
        <p class="mb-0">Kelola cakupan pekerjaan perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/work-scope/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Data
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if(isset($workScope) && !empty($workScope)): ?>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <?php if($workScope['image']): ?>
                        <img src="<?= base_url('uploads/work-scope/' . $workScope['image']) ?>" 
                             alt="Work Scope" class="img-fluid rounded shadow">
                    <?php else: ?>
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="bi bi-image text-muted display-4"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h4><?= $workScope['title'] ?></h4>
                    <?php if($workScope['subtitle']): ?>
                        <h6 class="text-muted"><?= $workScope['subtitle'] ?></h6>
                    <?php endif; ?>
                    
                    <p class="mt-3"><?= $workScope['description'] ?></p>

                    <?php if(isset($workScope['features']) && !empty($workScope['features'])): ?>
                        <div class="mb-3">
                            <strong>Features:</strong>
                            <ul class="mb-0">
                                <?php foreach($workScope['features'] as $feature): ?>
                                    <li><?= $feature ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= base_url('/admin/work-scope/edit/' . $workScope['id']) ?>" 
                           class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i> Edit
                        </a>
                        <a href="<?= base_url('/admin/work-scope/delete/' . $workScope['id']) ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Yakin ingin menghapus data work scope?')">
                            <i class="bi bi-trash me-2"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-briefcase display-1 text-muted"></i>
                <h4 class="mt-3">Belum ada data work scope</h4>
                <p class="text-muted">Silakan tambah data work scope terlebih dahulu</p>
                <a href="<?= base_url('/admin/work-scope/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Data
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>