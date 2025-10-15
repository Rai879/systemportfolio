<?= $this->include('templates/header') ?>

<!-- Products Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Produk Kami</h1>
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