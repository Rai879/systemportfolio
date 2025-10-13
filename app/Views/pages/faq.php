<?= $this->include('templates/header') ?>

<!-- FAQ Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">FAQ</h1>
                <p class="lead">Pertanyaan yang Sering Diajukan</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if(isset($faqs) && !empty($faqs)): ?>
                    <div class="accordion" id="faqAccordion">
                        <?php foreach($faqs as $index => $faq): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $index ?>">
                                    <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>">
                                        <?= $faq['question'] ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <?= $faq['answer'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-question-circle display-1 text-muted"></i>
                        <h3 class="mt-3">Belum ada FAQ</h3>
                        <p class="text-muted">FAQ akan segera diupdate</p>
                    </div>
                <?php endif; ?>

                <!-- Additional Help -->
                <div class="card mt-5 bg-light">
                    <div class="card-body text-center">
                        <h5>Masih punya pertanyaan?</h5>
                        <p class="text-muted">Hubungi kami untuk informasi lebih lanjut</p>
                        <a href="<?= base_url('/contact') ?>" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>