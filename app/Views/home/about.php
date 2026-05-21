<?= $this->include('templates/header') ?>

<style>
/* Apple-style specific for About Page */
.apple-about-hero {
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8rem 2rem 4rem;
    text-align: center;
    border-bottom: 1px solid #d2d2d7;
}

.apple-hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    letter-spacing: -0.03em;
    color: #1d1d1f;
    margin-bottom: 1rem;
}

.apple-hero-subtitle {
    font-size: 1.5rem;
    color: #86868b;
    font-weight: 400;
    max-width: 700px;
    margin: 0 auto;
}

.apple-section {
    padding: 6rem 2rem;
    background-color: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
}

.apple-section-dark {
    padding: 6rem 2rem;
    background-color: rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
}

.apple-container {
    max-width: 1100px;
    margin: 0 auto;
}

.apple-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 4rem;
    align-items: center;
}

@media (min-width: 768px) {
    .apple-grid {
        grid-template-columns: 1fr 1fr;
    }
}

.apple-text-content h2 {
    font-size: 2.5rem;
    font-weight: 600;
    letter-spacing: -0.02em;
    color: #1d1d1f;
    margin-bottom: 1.5rem;
}

.apple-text-content p {
    font-size: 1.15rem;
    line-height: 1.6;
    color: #424245;
    margin-bottom: 1.5rem;
}

.apple-stat-box {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    padding: 1.5rem 2.5rem;
    border-radius: 20px;
    margin-top: 1.5rem;
    text-align: center;
}

.apple-stat-box h3 {
    font-size: 3rem;
    font-weight: 700;
    color: #0071e3;
    margin: 0;
    line-height: 1;
}

.apple-stat-box small {
    font-size: 1rem;
    font-weight: 500;
    color: #86868b;
    display: block;
    margin-top: 0.5rem;
}

.apple-feature-list {
    list-style: none;
    padding: 0;
    margin-top: 2rem;
}

.apple-feature-list li {
    font-size: 1.1rem;
    color: #1d1d1f;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.apple-feature-list i {
    color: #0071e3;
    font-size: 1.2rem;
}

.apple-image {
    width: 100%;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.apple-team-section {
    text-align: center;
}

.apple-team-section h2 {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
}

.apple-team-section .subtitle {
    font-size: 1.2rem;
    color: #86868b;
    margin-bottom: 4rem;
}

.apple-team-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

@media (min-width: 600px) {
    .apple-team-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 900px) {
    .apple-team-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.apple-team-card {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0,0,0,0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.apple-team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
}

.apple-team-photo {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.apple-team-info {
    padding: 2rem;
}

.apple-team-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1d1d1f;
    margin-bottom: 0.25rem;
}

.apple-team-role {
    font-size: 1rem;
    color: #86868b;
}
</style>

<!-- About Header -->
<section class="apple-about-hero">
    <div class="apple-container">
        <h1 class="apple-hero-title">Tentang Kami</h1>
        <p class="apple-hero-subtitle">Mengenal lebih dekat <?= esc($aboutCompany['title'] ?? 'Perusahaan Kami') ?></p>
    </div>
</section>

<!-- About Content -->
<section class="apple-section">
    <div class="apple-container">
        <div class="apple-grid">
            <div class="apple-text-content">
                <?php if(isset($aboutCompany)): ?>
                    <h2><?= esc($aboutCompany['title'] ?? '') ?></h2>
                    <p style="font-weight: 600; color: #1d1d1f;"><?= esc($aboutCompany['subtitle'] ?? 'subtitle') ?></p>
                    <p><?= esc($aboutCompany['description'] ?? '') ?></p>
                    
                    <div class="apple-stat-box">
                        <h3><?= esc($aboutCompany['years_experience'] ?? '5') ?>+</h3>
                        <small>Tahun Pengalaman</small>
                    </div>
                    
                    <?php if(isset($aboutCompany['features']) && is_array($aboutCompany['features'])): ?>
                        <ul class="apple-feature-list">
                            <?php foreach($aboutCompany['features'] as $feature): ?>
                                <li><i class="bi bi-check-circle-fill"></i> <?= esc($feature) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <h2>Tentang Kami</h2>
                    <p>Informasi tentang perusahaan akan segera diupdate.</p>
                <?php endif; ?>
            </div>
            <div class="apple-image-wrapper">
                <?php if(isset($aboutCompany['image'])): ?>
                    <img src="<?= base_url('uploads/about/' . $aboutCompany['image']) ?>" alt="About Us" class="apple-image">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/about-placeholder.jpg') ?>" alt="About Us" class="apple-image">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<?php if(isset($teamMembers) && !empty($teamMembers)): ?>
<section class="apple-section-dark">
    <div class="apple-container apple-team-section">
        <h2>Tim Kami</h2>
        <p class="subtitle">Orang-orang di balik kesuksesan <?= esc($aboutCompany['title'] ?? 'kami') ?></p>
        
        <div class="apple-team-grid">
            <?php foreach($teamMembers as $member): ?>
                <div class="apple-team-card">
                    <?php if($member['photo']): ?>
                        <img src="<?= base_url('uploads/team/' . $member['photo']) ?>" class="apple-team-photo" alt="<?= esc($member['name']) ?>">
                    <?php else: ?>
                        <img src="<?= base_url('assets/images/team-placeholder.jpg') ?>" class="apple-team-photo" alt="Team Member">
                    <?php endif; ?>
                    <div class="apple-team-info">
                        <div class="apple-team-name"><?= esc($member['name']) ?></div>
                        <div class="apple-team-role"><?= esc($member['position']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?= $this->include('templates/footer') ?>