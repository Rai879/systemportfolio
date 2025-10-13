<?= $this->include('templates/header') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Solusi Teknologi untuk Rumah Sakit Modern</h1>
                <p class="lead mb-4">Membangun sistem informasi rumah sakit yang terintegrasi dan efisien untuk pelayanan kesehatan yang lebih baik.</p>
                <div class="d-flex gap-3">
                    <a href="<?= base_url('/contact') ?>" class="btn btn-light btn-lg">Hubungi Kami</a>
                    <a href="<?= base_url('/services') ?>" class="btn btn-outline-light btn-lg">Layanan Kami</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/images/hero-medical.png') ?>" alt="Medical Technology" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Unggulan</h2>
            <p class="text-muted">Solusi lengkap untuk kebutuhan sistem informasi rumah sakit Anda</p>
        </div>
        <div class="row">
            <?php if(isset($features) && !empty($features)): ?>
                <?php foreach($features as $feature): ?>
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            <div class="feature-icon text-<?= $feature['color'] ?>">
                                <i class="bi <?= $feature['icon'] ?>"></i>
                            </div>
                            <h4><?= $feature['title'] ?></h4>
                            <p class="text-muted"><?= $feature['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Fitur akan segera hadir</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Tentang Sanata Medical Suite</h2>
                <?php if(isset($aboutCompany)): ?>
                    <p class="lead"><?= $aboutCompany['description'] ?></p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <h3 class="mb-0"><?= $aboutCompany['years_experience'] ?? '5' ?>+</h3>
                            <small>Tahun Pengalaman</small>
                        </div>
                        <p>Dalam menyediakan solusi teknologi kesehatan</p>
                    </div>
                    <?php if(isset($aboutCompany['features'])): ?>
                        <ul class="list-unstyled">
                            <?php foreach($aboutCompany['features'] as $feature): ?>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <?= $feature ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Informasi tentang perusahaan akan segera diupdate.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if(isset($aboutCompany['image'])): ?>
                    <img src="<?= base_url('uploads/about/' . $aboutCompany['image']) ?>" alt="About Us" class="img-fluid rounded">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/about-placeholder.jpg') ?>" alt="About Us" class="img-fluid rounded">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="section-padding statistics-section">
    <div class="container">
        <div class="row text-center">
            <?php if(isset($statistics) && !empty($statistics)): ?>
                <?php foreach($statistics as $stat): ?>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="counter" data-target="<?= $stat['value'] ?>">0</div>
                        <h6><?= $stat['label'] ?></h6>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p>Data statistik akan segera tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Artikel Terbaru</h2>
            <p class="text-muted">Update terbaru seputar teknologi kesehatan</p>
        </div>
        <div class="row">
            <?php if(isset($latestBlogPosts) && !empty($latestBlogPosts)): ?>
                <?php foreach($latestBlogPosts as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card blog-card h-100">
                            <?php if($post['featured_image']): ?>
                                <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/blog-placeholder.jpg') ?>" class="card-img-top" alt="Blog Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <p class="card-text"><?= $post['excerpt'] ?></p>
                                <a href="<?= base_url('/blog/' . $post['slug']) ?>" class="btn btn-primary">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Artikel akan segera hadir</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('/blog') ?>" class="btn btn-outline-primary">Lihat Semua Artikel</a>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>