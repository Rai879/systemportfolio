<?= $this->include('templates/header') ?>

<!-- Services Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Layanan Kami</h1>
                <p class="lead">Layanan lengkap untuk transformasi digital rumah sakit</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Content -->
<section class="section-padding">
    <div class="container">
        <!-- Main Services -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded p-3 me-3">
                                <i class="bi bi-laptop text-white display-6"></i>
                            </div>
                            <h3 class="mb-0">Implementasi Sistem</h3>
                        </div>
                        <p class="text-muted">
                            Implementasi sistem informasi rumah sakit yang terintegrasi dengan pendekatan 
                            yang terstruktur dan metodologi yang terbukti efektif.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i> Analisis Kebutuhan</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Customization & Configuration</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Training & Sertifikasi</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Go-Live Support</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success rounded p-3 me-3">
                                <i class="bi bi-headset text-white display-6"></i>
                            </div>
                            <h3 class="mb-0">Support & Maintenance</h3>
                        </div>
                        <p class="text-muted">
                            Layanan dukungan teknis dan pemeliharaan sistem yang komprehensif 
                            untuk memastikan operasional berjalan lancar 24/7.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i> Technical Support 24/7</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Regular Maintenance</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> System Monitoring</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Performance Optimization</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Layanan</h2>
            <p class="text-muted">Kemampuan dan keunggulan layanan kami</p>
        </div>

        <div class="row">
            <?php if(isset($features) && !empty($features)): ?>
                <?php foreach($features as $feature): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 h-100 text-center">
                            <div class="card-body">
                                <div class="feature-icon text-<?= $feature['color'] ?> mb-3">
                                    <i class="bi <?= $feature['icon'] ?> display-4"></i>
                                </div>
                                <h5><?= $feature['title'] ?></h5>
                                <p class="text-muted"><?= $feature['description'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Informasi layanan akan segera diupdate</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Work Scope -->
        <?php if(isset($workScope)): ?>
            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4"><?= $workScope['title'] ?? 'Cakupan Pekerjaan' ?></h2>
                    <p class="lead"><?= $workScope['description'] ?></p>
                    
                    <?php if(isset($workScope['features'])): ?>
                        <div class="row mt-4">
                            <?php foreach($workScope['features'] as $feature): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill text-success mt-1 me-2"></i>
                                        <span><?= $feature ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php if(isset($workScope['image'])): ?>
                        <img src="<?= base_url('uploads/work-scope/' . $workScope['image']) ?>" 
                             alt="Work Scope" class="img-fluid rounded shadow">
                    <?php else: ?>
                        <img src="<?= base_url('assets/images/work-scope-placeholder.jpg') ?>" 
                             alt="Work Scope" class="img-fluid rounded shadow">
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Why Choose Us -->
        <?php if(isset($whyChooseUs) && !empty($whyChooseUs)): ?>
            <div class="row mt-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
                    <p class="text-muted">Keunggulan yang membuat kami berbeda</p>
                </div>
                
                <?php foreach($whyChooseUs as $item): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="bg-<?= $item['color'] ?> rounded p-2 me-3">
                                        <i class="bi <?= $item['icon'] ?> text-white"></i>
                                    </div>
                                    <div>
                                        <h5><?= $item['title'] ?></h5>
                                        <p class="text-muted mb-0"><?= $item['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center py-5">
                        <h3 class="fw-bold">Siap Transformasi Digital?</h3>
                        <p class="mb-4">Mulai perjalanan transformasi digital rumah sakit Anda bersama kami</p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="<?= base_url('/contact') ?>" class="btn btn-light btn-lg">
                                <i class="bi bi-telephone"></i> Hubungi Sales
                            </a>
                            <a href="<?= base_url('/products') ?>" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-box"></i> Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>