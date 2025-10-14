<?= $this->include('templates/header') ?>

<!-- About Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat <?= $aboutCompany['title'] ?></p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Tentang <?= $aboutCompany['title'] ?></h2>
                <?php if(isset($aboutCompany)): ?>
                    <p><b><?= $aboutCompany['subtitle'] ?? 'subtitle' ?></b></p>
                    <p class="lead"><?= $aboutCompany['description'] ?></p>
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <h3 class="mb-0"><?= $aboutCompany['years_experience'] ?? '5' ?>+</h3>
                            <small>Tahun Pengalaman</small>
                        </div>
                        <br>
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

        <!-- Team Section -->
        <?php if(isset($teamMembers) && !empty($teamMembers)): ?>
            <div class="row mt-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="fw-bold">Tim Kami</h2>
                    <p class="text-muted">Orang-orang di balik kesuksesan Sanata Medical Suite</p>
                </div>
                <?php foreach($teamMembers as $member): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center h-100">
                            <?php if($member['photo']): ?>
                                <img src="<?= base_url('uploads/team/' . $member['photo']) ?>" class="card-img-top" alt="<?= $member['name'] ?>" style="height: 250px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/team-placeholder.jpg') ?>" class="card-img-top" alt="Team Member" style="height: 250px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $member['name'] ?></h5>
                                <p class="card-text text-muted"><?= $member['position'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('templates/footer') ?>