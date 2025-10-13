    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Sanata Medical Suite</h5>
                    <p><?= $siteSettings['footer_description'] ?? 'Solusi teknologi terdepan untuk rumah sakit modern.' ?></p>
                    <div class="social-links">
                        <?php if(isset($siteSettings['social_facebook'])): ?>
                            <a href="<?= $siteSettings['social_facebook'] ?>" class="text-light me-2"><i class="bi bi-facebook"></i></a>
                        <?php endif; ?>
                        <?php if(isset($siteSettings['social_instagram'])): ?>
                            <a href="<?= $siteSettings['social_instagram'] ?>" class="text-light me-2"><i class="bi bi-instagram"></i></a>
                        <?php endif; ?>
                        <?php if(isset($siteSettings['social_linkedin'])): ?>
                            <a href="<?= $siteSettings['social_linkedin'] ?>" class="text-light me-2"><i class="bi bi-linkedin"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak Kami</h5>
                    <p>
                        <i class="bi bi-geo-alt"></i> <?= $siteSettings['contact_address'] ?? 'Jl. Contoh No. 123, Jakarta' ?><br>
                        <i class="bi bi-envelope"></i> <?= $siteSettings['contact_email'] ?? 'info@sanatamedical.com' ?><br>
                        <i class="bi bi-phone"></i> <?= $siteSettings['contact_phone'] ?? '+62 21 1234 5678' ?>
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('/about') ?>" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li><a href="<?= base_url('/services') ?>" class="text-light text-decoration-none">Layanan</a></li>
                        <li><a href="<?= base_url('/blog') ?>" class="text-light text-decoration-none">Blog</a></li>
                        <li><a href="<?= base_url('/faq') ?>" class="text-light text-decoration-none">FAQ</a></li>
                        <li><a href="<?= base_url('/privacy-policy') ?>" class="text-light text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; <?= date('Y') ?> Sanata Medical Suite. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Counter animation for statistics
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + '+';
                }
            }, 20);
        }

        // Initialize counters when in viewport
        function initCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
            });
        }

        // Intersection Observer for counters
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const counterSection = document.querySelector('.statistics-section');
            if (counterSection) {
                observer.observe(counterSection);
            }
        });
    </script>
</body>
</html>