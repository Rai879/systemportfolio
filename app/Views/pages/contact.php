<?= $this->include('templates/header') ?>

<!-- Contact Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Kontak Kami</h1>
                <p class="lead">Hubungi kami untuk informasi lebih lanjut</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Flash Messages -->
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Informasi Kontak</h5>
                                <div class="mb-3">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <strong>Alamat:</strong><br>
                                    <?= $siteSettings['contact_address'] ?? 'Jl. Contoh No. 123, Jakarta' ?>
                                </div>
                                <div class="mb-3">
                                    <i class="bi bi-envelope text-primary me-2"></i>
                                    <strong>Email:</strong><br>
                                    <?= $siteSettings['contact_email'] ?? 'info@sanatamedical.com' ?>
                                </div>
                                <div class="mb-3">
                                    <i class="bi bi-phone text-primary me-2"></i>
                                    <strong>Telepon:</strong><br>
                                    <?= $siteSettings['contact_phone'] ?? '+62 21 1234 5678' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kirim Pesan</h5>
                                <form action="<?= base_url('/contact') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subjek</label>
                                        <input type="text" class="form-control" id="subject" name="subject" value="<?= old('subject') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Pesan</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required><?= old('message') ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>