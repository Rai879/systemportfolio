<?= $this->include('templates/header') ?>

<!-- Blog Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Blog & Artikel</h1>
                <p class="lead">Update terbaru seputar teknologi kesehatan dan sistem informasi rumah sakit</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <?php if(isset($blogPosts) && !empty($blogPosts)): ?>
                    <?php foreach($blogPosts as $post): ?>
                        <article class="card mb-4 blog-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <?php if($post['featured_image']): ?>
                                        <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="<?= $post['title'] ?>">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/images/blog-placeholder.jpg') ?>" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Blog Image">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2 class="card-title h5"><?= $post['title'] ?></h2>
                                        <p class="card-text text-muted small">
                                            <i class="bi bi-calendar"></i> <?= date('d F Y', strtotime($post['created_at'])) ?> | 
                                            <i class="bi bi-person"></i> <?= $post['author'] ?> |
                                            <i class="bi bi-tag"></i> <?= $post['category'] ?>
                                        </p>
                                        <p class="card-text"><?= $post['excerpt'] ?></p>
                                        <a href="<?= base_url('/blog/' . $post['slug']) ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>

                    <!-- Pagination -->
                    <?php if(isset($pager)): ?>
                        <nav aria-label="Page navigation">
                            <?= $pager->links() ?>
                        </nav>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-journal-text display-1 text-muted"></i>
                        <h3 class="mt-3">Belum ada artikel</h3>
                        <p class="text-muted">Artikel akan segera hadir</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-tags"></i> Kategori</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li><a href="<?= base_url('/blog') ?>" class="text-decoration-none">Semua Kategori</a></li>
                            <li><a href="<?= base_url('/blog/category/teknologi') ?>" class="text-decoration-none">Teknologi</a></li>
                            <li><a href="<?= base_url('/blog/category/kesehatan') ?>" class="text-decoration-none">Kesehatan</a></li>
                            <li><a href="<?= base_url('/blog/category/rumah-sakit') ?>" class="text-decoration-none">Rumah Sakit</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Latest Posts -->
                <?php if(isset($latestPosts) && !empty($latestPosts)): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-clock"></i> Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach($latestPosts as $latest): ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <h6 class="mb-1"><a href="<?= base_url('/blog/' . $latest['slug']) ?>" class="text-decoration-none"><?= $latest['title'] ?></a></h6>
                                    <small class="text-muted"><?= date('d M Y', strtotime($latest['created_at'])) ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>