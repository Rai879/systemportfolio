<?= $this->include('templates/header') ?>

<!-- Hero Section -->
<section class="hero-section p-0 vh-100">
    <?php if (isset($heroSlides) && !empty($heroSlides)): ?> 
        <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel">
            
            <div class="carousel-indicators">
                <?php foreach ($heroSlides as $i => $slide): ?>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $i ?>" 
                        class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" 
                        aria-label="Slide <?= $i + 1 ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner h-100">
                <?php foreach ($heroSlides as $i => $slide): ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?> h-100">
                        
                        <?php if (isset($slide['image']) && $slide['image']): ?>
                            <img src="<?= base_url('uploads/hero/' . $slide['image']) ?>" 
                                 class="d-block w-100 h-100" 
                                 style="object-fit: cover;" alt="<?= esc($slide['title']) ?>">
                            
                            <div class="carousel-caption d-flex align-items-center justify-content-start text-start p-5 h-100">
                                <div class="container text-white">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-9">
                                            
                                            <?php if (isset($slide['subtitle']) && $slide['subtitle']): ?>
                                                <p class="lead mb-2 text-uppercase fw-semibold text-shadow"><?= esc($slide['subtitle']) ?></p>
                                            <?php endif; ?>

                                            <h1 class="display-3 fw-bolder mb-3 text-shadow"><?= esc($slide['title']) ?></h1>
                                            
                                            <?php if (isset($slide['description']) && $slide['description']): ?>
                                                <p class="mb-4 d-none d-sm-block text-shadow"><?= esc($slide['description']) ?></p>
                                            <?php endif; ?>

                                            <?php if (isset($slide['button_text']) && $slide['button_text'] && isset($slide['button_link']) && $slide['button_link']): ?>
                                                <a href="<?= esc($slide['button_link']) ?>" class="btn btn-light btn-lg mt-2"><?= esc($slide['button_text']) ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="hero-slide-placeholder bg-primary d-flex align-items-center justify-content-center h-100">
                                <div class="container text-center text-white">
                                    <h1 class="display-4 fw-bold mb-3"><?= esc($slide['title']) ?></h1>
                                    <?php if (isset($slide['subtitle']) && $slide['subtitle']): ?>
                                        <p class="lead mb-4"><?= esc($slide['subtitle']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            
        </div>
    <?php else: ?>
        <div class="container py-5 text-center bg-light min-vh-50 d-flex align-items-center justify-content-center">
            <div>
                <h1 class="display-4 fw-bold mb-4">Selamat Datang</h1>
                <p class="lead">Solusi teknologi untuk kebutuhan Anda. (Mohon tambahkan Hero Slide di Admin Panel)</p>
            </div>
        </div>
    <?php endif; ?>
</section>


<!-- Features Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Unggulan</h2>
            <p class="text-muted">Solusi lengkap untuk kebutuhan sistem informasi rumah sakit Anda</p>
        </div>
        <div class="row">
            <?php if (isset($features) && !empty($features)): ?>
                <?php foreach ($features as $feature): ?>
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
                <h2 class="fw-bold mb-4">Tentang <?= $siteSettings['site_name'] ?? 'Aplikasi Rumah Sakit' ?></h2>
                <?php if (isset($aboutCompany)): ?>
                    <p class="lead"><?= $aboutCompany['description'] ?></p>
                    <div class="bg-primary text-white rounded p-3 me-3">
                        <h3 class="mb-0"><?= $aboutCompany['years_experience'] ?? '5' ?>+</h3>
                        <small>Tahun Pengalaman</small>
                    </div>
                    <br>
                    <?php if (isset($aboutCompany['features'])): ?>
                        <ul class="list-unstyled">
                            <?php foreach ($aboutCompany['features'] as $feature): ?>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <?= $feature ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Informasi tentang perusahaan akan segera diupdate.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if (isset($aboutCompany['image'])): ?>
                    <img src="<?= base_url('uploads/about/' . $aboutCompany['image']) ?>" alt="About Us"
                        class="img-fluid rounded">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/about-placeholder.jpg') ?>" alt="About Us"
                        class="img-fluid rounded">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="section-padding statistics-section">
    <div class="container">
        <div class="row text-center">
            <?php if (isset($statistics) && !empty($statistics)): ?>
                <?php foreach ($statistics as $stat): ?>
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
            <?php if (isset($latestBlogPosts) && !empty($latestBlogPosts)): ?>
                <?php foreach ($latestBlogPosts as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card blog-card h-100">
                            <?php if ($post['featured_image']): ?>
                                <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" class="card-img-top"
                                    alt="<?= $post['title'] ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/blog-placeholder.jpg') ?>" class="card-img-top"
                                    alt="Blog Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <p class="card-text"><?= $post['excerpt'] ?></p>
                                <a href="<?= base_url('/blog/' . $post['slug']) ?>" class="btn btn-primary">Baca
                                    Selengkapnya</a>
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