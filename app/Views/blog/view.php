<?= $this->include('templates/header') ?>

<!-- Blog Detail Header -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/blog') ?>">Blog</a></li>
                        <li class="breadcrumb-item active"><?= $post['title'] ?></li>
                    </ol>
                </nav>
                
                <h1 class="display-5 fw-bold"><?= $post['title'] ?></h1>
                <div class="d-flex align-items-center text-muted mb-4">
                    <i class="bi bi-calendar me-2"></i> <?= date('d F Y', strtotime($post['created_at'])) ?> |
                    <i class="bi bi-person ms-3 me-2"></i> <?= $post['author'] ?> |
                    <i class="bi bi-tag ms-3 me-2"></i> <?= $post['category'] ?> |
                    <i class="bi bi-eye ms-3 me-2"></i> <?= $post['views'] ?? 0 ?> views
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Detail Content -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if($post['featured_image']): ?>
                    <img src="<?= base_url('uploads/blog/' . $post['featured_image']) ?>" alt="<?= $post['title'] ?>" class="img-fluid rounded mb-4 w-100">
                <?php endif; ?>
                
                <article class="blog-content">
                    <?= $post['content'] ?>
                </article>

                <!-- Share Buttons -->
                <div class="mt-5 pt-4 border-top">
                    <h6>Bagikan artikel ini:</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i> Facebook</a>
                        <a href="#" class="btn btn-outline-info btn-sm"><i class="bi bi-twitter"></i> Twitter</a>
                        <a href="#" class="btn btn-outline-danger btn-sm"><i class="bi bi-linkedin"></i> LinkedIn</a>
                    </div>
                </div>

                <!-- Related Posts -->
                <?php if(isset($relatedPosts) && !empty($relatedPosts)): ?>
                    <div class="mt-5 pt-4 border-top">
                        <h4>Artikel Terkait</h4>
                        <div class="row">
                            <?php foreach($relatedPosts as $related): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title"><?= $related['title'] ?></h6>
                                            <a href="<?= base_url('/blog/' . $related['slug']) ?>" class="btn btn-primary btn-sm">Baca</a>
                                        </div>
                                    </div>
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