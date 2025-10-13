<?= $this->include('templates/header') ?>

<!-- Products Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Produk & Layanan</h1>
                <p class="lead">Solusi teknologi lengkap untuk rumah sakit modern</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Content -->
<section class="section-padding">
    <div class="container">
        <!-- Product Categories -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kategori Produk</h2>
            <p class="text-muted">Pilih kategori produk yang sesuai dengan kebutuhan Anda</p>
        </div>

        <div class="row mb-5">
            <div class="col-md-3 mb-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-hospital display-4 text-primary mb-3"></i>
                        <h5>SIMRS</h5>
                        <p class="text-muted">Sistem Informasi Manajemen Rumah Sakit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-clipboard-plus display-4 text-success mb-3"></i>
                        <h5>EMR</h5>
                        <p class="text-muted">Electronic Medical Record</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-people display-4 text-warning mb-3"></i>
                        <h5>HR Portal</h5>
                        <p class="text-muted">Human Resources Management</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-graph-up display-4 text-info mb-3"></i>
                        <h5>Financial</h5>
                        <p class="text-muted">Sistem Keuangan & Akuntansi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products List -->
        <div class="row">
            <?php if(isset($products) && !empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            <?php if($product['image']): ?>
                                <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                     class="card-img-top" alt="<?= $product['name'] ?>" 
                                     style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/product-placeholder.jpg') ?>" 
                                     class="card-img-top" alt="Product Image"
                                     style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <span class="badge bg-primary mb-2"><?= $product['category'] ?></span>
                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                <p class="card-text"><?= $product['description'] ?></p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="<?= base_url('/products/' . $product['id']) ?>" 
                                   class="btn btn-primary w-100">
                                    <i class="bi bi-info-circle"></i> Detail Produk
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box display-1 text-muted"></i>
                    <h3 class="mt-3">Produk Akan Segera Hadir</h3>
                    <p class="text-muted">Kami sedang mempersiapkan produk terbaik untuk Anda</p>
                    <a href="<?= base_url('/contact') ?>" class="btn btn-primary mt-3">Hubungi Kami</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body text-center py-5">
                        <h3 class="fw-bold">Butuh Solusi Kustom?</h3>
                        <p class="text-muted mb-4">Kami siap mengembangkan sistem sesuai kebutuhan spesifik rumah sakit Anda</p>
                        <a href="<?= base_url('/contact') ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-chat-dots"></i> Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>