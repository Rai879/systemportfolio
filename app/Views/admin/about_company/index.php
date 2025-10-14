<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">About Company</h2>
        <p class="mb-0">Kelola informasi tentang perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/about-company/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Data
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if(isset($aboutCompany) && !empty($aboutCompany)): ?>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <?php if($aboutCompany['image']): ?>
                        <img src="<?= base_url('uploads/about/' . $aboutCompany['image']) ?>" 
                             alt="About Company" class="img-fluid rounded shadow">
                    <?php else: ?>
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="bi bi-image text-muted display-4"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h4><?= $aboutCompany['title'] ?></h4>
                    <?php if($aboutCompany['subtitle']): ?>
                        <h6 class="text-muted"><?= $aboutCompany['subtitle'] ?></h6>
                    <?php endif; ?>
                    
                    <p class="mt-3"><?= $aboutCompany['description'] ?></p>
                    
                    <?php if($aboutCompany['years_experience']): ?>
                        <div class="mb-3">
                            <strong>Years Experience:</strong> <?= $aboutCompany['years_experience'] ?> tahun
                        </div>
                    <?php endif; ?>

                    <?php if(isset($aboutCompany['features']) && !empty($aboutCompany['features'])): ?>
                        <div class="mb-3">
                            <strong>Features:</strong>
                            <ul class="mb-0">
                                <?php foreach($aboutCompany['features'] as $feature): ?>
                                    <li><?= $feature ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= base_url('/admin/about-company/edit/' . $aboutCompany['id']) ?>" 
                           class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i> Edit
                        </a>
                        <a href="<?= base_url('/admin/about-company/delete/' . $aboutCompany['id']) ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Yakin ingin menghapus data about company?')">
                            <i class="bi bi-trash me-2"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-building display-1 text-muted"></i>
                <h4 class="mt-3">Belum ada data about company</h4>
                <p class="text-muted">Silakan tambah data about company terlebih dahulu</p>
                <a href="<?= base_url('/admin/about-company/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Data
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>