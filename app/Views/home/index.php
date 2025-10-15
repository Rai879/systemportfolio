<?= $this->include('templates/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* === [ GLOBAL STYLES ] === */
    :root {
        --primary-color: #0d6efd;
        --dark-blue: #051a49;
        --secondary-text: #6c757d;
        --bg-light: #f8f9fa;
        --bg-dark-section: #0a1834;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        --card-hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .section-padding {
        padding: 80px 0;
    }

    .section-title {
        color: var(--dark-blue);
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        color: var(--secondary-text);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* === [ HERO SECTION ] === */
    .hero-section {
        background: linear-gradient(135deg, #e6ecfa 0%, #f4f7fc 100%);
        padding: 40px 0;
        overflow: hidden;
    }

    .hero-section .display-4 {
        color: var(--dark-blue);
        font-weight: 700; /* Lebih tebal */
    }

    .hero-section .highlight {
        color: var(--primary-color);
    }

    .hero-section .lead {
        font-weight: 500;
        color: var(--primary-color);
    }

    .hero-section .hero-description {
        color: var(--secondary-text);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .hero-section .btn-hero-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        font-weight: 500;
        padding: 0.8rem 2rem;
        border-radius: 50px; /* Tombol rounded */
        transition: all 0.3s ease;
    }

    .hero-section .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
    }
    
    .hero-section .img-fluid {
        max-height: 450px;
        /* Animasi gambar mengambang */
        animation: floatAnimation 4s ease-in-out infinite;
    }

    @keyframes floatAnimation {
        0% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0); }
    }
    
    /* Carousel styling */
    #heroCarousel .carousel-indicators button {
        background-color: var(--primary-color);
        width: 12px;
        height: 12px;
        border-radius: 100%;
        margin: 0 5px;
    }

    #heroCarousel .carousel-control-prev-icon,
    #heroCarousel .carousel-control-next-icon {
        background-color: var(--dark-blue);
        border-radius: 50%;
        padding: 20px;
    }


    /* === [ FEATURES SECTION ] === */
    .feature-card {
        background: #fff;
        padding: 40px 25px;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-hover-shadow);
    }

    .feature-card .feature-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }
    
    .feature-card h4 {
        color: var(--dark-blue);
        font-weight: 600;
        margin-bottom: 1rem;
    }


    /* === [ ABOUT SECTION ] === */
    .about-box {
        background-color: var(--primary-color);
        display: inline-block;
        border-radius: 10px;
        padding: 20px 30px;
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
    }
    
    .about-box h3 {
        font-weight: 700;
    }


    /* === [ STATISTICS SECTION ] === */
    .statistics-section {
        background-color: var(--dark-blue);
        color: #fff;
    }

    .statistics-section .counter {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .statistics-section h6 {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }


    /* === [ BLOG SECTION ] === */
    .blog-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-hover-shadow);
    }

    .blog-card .card-body {
        padding: 25px;
    }
    
    .blog-card .card-title {
        font-weight: 600;
        color: var(--dark-blue);
    }
    
    .blog-card .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
    }
</style>

<section class="hero-section">
    <?php if (isset($heroSlides) && !empty($heroSlides)): ?>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <?php if (count($heroSlides) > 1): ?>
                <div class="carousel-indicators">
                    <?php foreach ($heroSlides as $i => $slide): ?>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-inner">
                <?php foreach ($heroSlides as $i => $slide): ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                        <div class="container py-5">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12 text-start pt-lg-5 pb-lg-5" data-aos="fade-right">
                                    <?php if (isset($slide['subtitle']) && $slide['subtitle']): ?>
                                        <p class="lead mb-2 text-uppercase fw-semibold"><?= esc($slide['subtitle']) ?></p>
                                    <?php endif; ?>
                                    
                                    <h1 class="display-4 fw-bolder mb-3"><?= str_replace('Solution', '<span class="highlight">Solution</span>', esc($slide['title'])) ?></h1>

                                    <?php if (isset($slide['description']) && $slide['description']): ?>
                                        <p class="hero-description d-none d-sm-block"><?= esc($slide['description']) ?></p>
                                    <?php endif; ?>

                                    <?php if (isset($slide['button_text']) && $slide['button_text'] && isset($slide['button_link']) && $slide['button_link']): ?>
                                        <a href="<?= esc($slide['button_link']) ?>" class="btn btn-hero-primary btn-lg mt-2">
                                            <?= esc($slide['button_text']) ?>
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 col-md-12 d-flex justify-content-center justify-content-lg-end" data-aos="fade-left">
                                    <?php if (isset($slide['image']) && $slide['image']): ?>
                                        <img src="<?= base_url('uploads/hero/' . $slide['image']) ?>" class="img-fluid" style="width: auto;" alt="<?= esc($slide['title']) ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($heroSlides) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="container py-5 text-center d-flex align-items-center justify-content-center" style="min-height: 400px;">
            <div>
                <h1 class="display-4 fw-bold mb-4">Selamat Datang</h1>
                <p class="lead">Solusi teknologi untuk kebutuhan Anda. (Mohon tambahkan Hero Slide di Admin Panel)</p>
            </div>
        </div>
    <?php endif; ?>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Fitur Unggulan</h2>
            <p class="section-subtitle">Solusi lengkap untuk kebutuhan sistem informasi rumah sakit Anda</p>
        </div>
        <div class="row">
            <?php if (isset($features) && !empty($features)): ?>
                <?php foreach ($features as $key => $feature): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $key * 100 ?>">
                        <div class="feature-card text-center">
                            <div class="feature-icon text-<?= $feature['color'] ?>">
                                <i class="bi <?= $feature['icon'] ?>"></i>
                            </div>
                            <h4><?= $feature['title'] ?></h4>
                            <p class="text-muted mb-0"><?= $feature['description'] ?></p>
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

<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title mb-4">Tentang <?= $siteSettings['site_name'] ?? 'Aplikasi Rumah Sakit' ?></h2>
                <?php if (isset($aboutCompany)): ?>
                    <p class="lead text-muted"><?= $aboutCompany['description'] ?></p>
                    <div class="d-flex align-items-center my-4">
                        <div class="about-box text-white text-center me-4">
                            <h3 class="mb-0"><?= $aboutCompany['years_experience'] ?? '5' ?>+</h3>
                            <small>Tahun Pengalaman</small>
                        </div>
                        <?php if (isset($aboutCompany['features'])): ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($aboutCompany['features'] as $feature): ?>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> <?= $feature ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p>Informasi tentang perusahaan akan segera diupdate.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <?php if (isset($aboutCompany['image'])): ?>
                    <img src="<?= base_url('uploads/about/' . $aboutCompany['image']) ?>" alt="About Us" class="img-fluid rounded shadow-lg">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/about-placeholder.jpg') ?>" alt="About Us" class="img-fluid rounded shadow-lg">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="section-padding statistics-section">
    <div class="container">
        <div class="row text-center">
            <?php if (isset($statistics) && !empty($statistics)): ?>
                <?php foreach ($statistics as $key => $stat): ?>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $key * 100 ?>">
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

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Artikel Terbaru</h2>
            <p class="section-subtitle">Update terbaru seputar teknologi kesehatan</p>
        </div>
        <div class="row">
            <?php if (isset($latestBlogPosts) && !empty($latestBlogPosts)): ?>
                <?php foreach ($latestBlogPosts as $key => $post): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $key * 100 ?>">
                        <div class="card blog-card h-100">
                            <?php if ($post['featured_image']): ?>
                                <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/blog-placeholder.jpg') ?>" class="card-img-top" alt="Blog Image">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <p class="card-text text-muted small flex-grow-1"><?= $post['excerpt'] ?></p>
                                <a href="<?= base_url('/blog/' . $post['slug']) ?>" class="btn btn-primary mt-3 align-self-start">Baca Selengkapnya</a>
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
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="<?= base_url('/blog') ?>" class="btn btn-outline-primary">Lihat Semua Artikel</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800, // Durasi animasi
        once: true // Animasi hanya berjalan sekali
    });
</script>


<?= $this->include('templates/footer') ?>