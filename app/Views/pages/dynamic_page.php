<?= $this->include('templates/header') ?>

<style>
/* Apple-style specific for Dynamic Pages */
.apple-page-hero {
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8rem 2rem 4rem;
    text-align: center;
    border-bottom: 1px solid #d2d2d7;
}

.apple-hero-title {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #1d1d1f;
    margin-bottom: 1rem;
}

.apple-section {
    padding: 6rem 2rem;
    background-color: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
}

.apple-container {
    max-width: 800px;
    margin: 0 auto;
}

.apple-content-card {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 24px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.apple-content-card h1, .apple-content-card h2, .apple-content-card h3 {
    color: #1d1d1f;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    letter-spacing: -0.01em;
}

.apple-content-card h2 {
    font-size: 1.5rem;
}

.apple-content-card p, .apple-content-card li {
    font-size: 1.05rem;
    line-height: 1.6;
    color: #424245;
    margin-bottom: 1rem;
}

.apple-content-card ul {
    margin-bottom: 2rem;
}
</style>

<!-- Page Header -->
<section class="apple-page-hero">
    <div class="apple-container">
        <h1 class="apple-hero-title"><?= esc($page['title']) ?></h1>
    </div>
</section>

<!-- Page Content -->
<section class="apple-section">
    <div class="apple-container">
        <div class="apple-content-card">
            <?= $page['content'] ?>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>
