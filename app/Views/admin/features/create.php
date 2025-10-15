<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Tambah Feature</h2>
        <p class="mb-0">Tambahkan fitur unggulan perusahaan</p>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger mt-3">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/features') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/features/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= session('errors.title') ? 'is-invalid' : '' ?>" id="title"
                    name="title" value="<?= old('title') ?>" required>
                <?php if (session('errors.title')): ?>
                    <div class="invalid-feedback"><?= session('errors.title') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>" id="description"
                    name="description" rows="3" required><?= old('description') ?></textarea>
                <?php if (session('errors.description')): ?>
                    <div class="invalid-feedback"><?= session('errors.description') ?></div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control <?= session('errors.icon') ? 'is-invalid' : '' ?>"
                            id="icon" name="icon" value="<?= old('icon') ?>" required placeholder="bi-star-fill">
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal"
                            data-bs-target="#iconSelectorModal">
                            <i class="bi bi-grid-3x3-gap-fill me-1"></i> Pilih Icon
                        </button>
                        <?php if (session('errors.icon')): ?>
                            <div class="invalid-feedback"><?= session('errors.icon') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center mt-2">
                        <div class="me-3">Preview:</div>
                        <i id="icon-preview" class="bi <?= old('icon', 'bi-question-square') ?> fs-3 text-primary"></i>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                    <select class="form-select <?= session('errors.color') ? 'is-invalid' : '' ?>" id="color"
                        name="color" required>
                        <option value="">Pilih Warna</option>
                        <?php
                        $colorOptions = [
                            'primary' => 'Primary (Biru)',
                            'secondary' => 'Secondary (Abu-abu)',
                            'success' => 'Success (Hijau)',
                            'danger' => 'Danger (Merah)',
                            'warning' => 'Warning (Kuning)',
                            'info' => 'Info (Cyan)',
                            'dark' => 'Dark (Hitam)'
                        ];
                        ?>
                        <?php foreach ($colorOptions as $value => $label): ?>
                            <option value="<?= $value ?>" <?= old('color') == $value ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (session('errors.color')): ?>
                        <div class="invalid-feedback"><?= session('errors.color') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order"
                        value="<?= old('sort_order', 0) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check">
                        <?php
                        $isActive = old('is_active') === null ? true : (bool) old('is_active');
                        ?>
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            <?= $isActive ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">
                            Aktif
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Simpan
                </button>
                <a href="<?= base_url('/admin/features') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="iconSelectorModal" tabindex="-1" aria-labelledby="iconSelectorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconSelectorModalLabel">Pilih Icon Bootstrap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="icon-search" placeholder="Cari icon...">
                <div id="icon-list" class="row row-cols-6 row-cols-md-8 row-cols-lg-10 g-3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const iconListContainer = document.getElementById('icon-list');
        const iconSearchInput = document.getElementById('icon-search');
        const iconSelectorModal = new bootstrap.Modal(document.getElementById('iconSelectorModal'));

        // Data dummy ikon Bootstrap yang sering digunakan (Anda bisa kembangkan sendiri)
        const allIcons = [
            // Home & Navigation
            'bi-house-door', 'bi-house-door-fill', 'bi-compass', 'bi-map', 'bi-pin-map', 'bi-pin-map-fill',

            // Settings & Tools
            'bi-gear', 'bi-gear-fill', 'bi-tools', 'bi-sliders', 'bi-sliders2', 'bi-wrench',

            // Communication
            'bi-telephone', 'bi-telephone-fill', 'bi-envelope', 'bi-envelope-fill', 'bi-chat-dots',
            'bi-chat-dots-fill', 'bi-chat-left-text', 'bi-headset', 'bi-megaphone', 'bi-broadcast',

            // Business & Finance
            'bi-briefcase', 'bi-briefcase-fill', 'bi-wallet', 'bi-wallet2', 'bi-credit-card',
            'bi-cash-coin', 'bi-currency-dollar', 'bi-graph-up', 'bi-graph-up-arrow', 'bi-receipt',

            // E-commerce
            'bi-bag', 'bi-bag-fill', 'bi-cart', 'bi-cart-fill', 'bi-basket', 'bi-basket-fill',
            'bi-shop', 'bi-shop-window', 'bi-tags', 'bi-tags-fill', 'bi-ticket-perforated',

            // Data & Analytics
            'bi-bar-chart', 'bi-bar-chart-fill', 'bi-pie-chart', 'bi-pie-chart-fill',
            'bi-graph-down', 'bi-clipboard-data', 'bi-speedometer', 'bi-speedometer2',

            // Technology & Computing
            'bi-laptop', 'bi-phone', 'bi-tablet', 'bi-display', 'bi-cpu', 'bi-database',
            'bi-database-fill', 'bi-server', 'bi-terminal', 'bi-code-slash', 'bi-file-code',

            // Cloud & Network
            'bi-wifi', 'bi-cloud', 'bi-cloud-upload', 'bi-cloud-download', 'bi-router',
            'bi-hdd-network', 'bi-signal', 'bi-broadcast-pin',

            // Security
            'bi-shield-check', 'bi-shield-fill-check', 'bi-shield-lock', 'bi-lock',
            'bi-lock-fill', 'bi-key', 'bi-key-fill', 'bi-fingerprint', 'bi-eye', 'bi-eye-slash',

            // Media
            'bi-camera', 'bi-camera-fill', 'bi-image', 'bi-images', 'bi-film', 'bi-play-circle',
            'bi-music-note-beamed', 'bi-file-earmark-image', 'bi-palette', 'bi-brush',

            // Documents
            'bi-file-earmark', 'bi-file-earmark-text', 'bi-file-earmark-pdf', 'bi-folder',
            'bi-folder-fill', 'bi-archive', 'bi-book', 'bi-journal-text', 'bi-newspaper',

            // Time & Calendar
            'bi-calendar', 'bi-calendar-check', 'bi-calendar-event', 'bi-clock',
            'bi-clock-fill', 'bi-alarm', 'bi-hourglass', 'bi-stopwatch',

            // People & Users
            'bi-people', 'bi-people-fill', 'bi-person', 'bi-person-fill', 'bi-person-badge',
            'bi-person-circle', 'bi-person-check', 'bi-person-gear', 'bi-person-workspace',

            // Status & Notifications
            'bi-bell', 'bi-bell-fill', 'bi-check-circle', 'bi-check-circle-fill',
            'bi-x-circle', 'bi-exclamation-circle', 'bi-info-circle', 'bi-star', 'bi-star-fill',

            // Actions
            'bi-arrow-repeat', 'bi-download', 'bi-upload', 'bi-share', 'bi-send',
            'bi-trash', 'bi-pencil', 'bi-plus-circle', 'bi-search', 'bi-filter',

            // Health & Medical
            'bi-heart', 'bi-heart-fill', 'bi-heart-pulse', 'bi-heart-pulse-fill',
            'bi-hospital', 'bi-bandaid', 'bi-capsule', 'bi-thermometer',

            // Transport & Delivery
            'bi-truck', 'bi-box-seam', 'bi-box', 'bi-box-arrow-right', 'bi-airplane',
            'bi-car-front', 'bi-bicycle', 'bi-geo-alt', 'bi-geo-alt-fill',

            // Special Features
            'bi-lightning', 'bi-lightning-fill', 'bi-gem', 'bi-award', 'bi-trophy',
            'bi-gift', 'bi-rocket', 'bi-rocket-takeoff', 'bi-fire', 'bi-brightness-high',

            // Task Management
            'bi-clipboard', 'bi-clipboard-check', 'bi-list-task', 'bi-list-check',
            'bi-check2-square', 'bi-kanban', 'bi-diagram-3', 'bi-puzzle',

            // UI Elements
            'bi-grid', 'bi-grid-3x3', 'bi-layout-sidebar', 'bi-menu-button-wide',
            'bi-window', 'bi-columns', 'bi-layers', 'bi-stack',

            // Miscellaneous
            'bi-globe', 'bi-globe2', 'bi-infinity', 'bi-bookmark', 'bi-flag',
            'bi-lightbulb', 'bi-power', 'bi-plugin', 'bi-toggles', 'bi-battery-charging'
        ];

        // --- FUNGSI UTAMA ICON SELECTOR ---

        // 1. Fungsi untuk menampilkan daftar ikon
        function renderIcons(icons) {
            iconListContainer.innerHTML = '';
            icons.forEach(iconName => {
                const iconElement = document.createElement('div');
                iconElement.className = 'col text-center icon-item p-2';
                iconElement.innerHTML = `
                    <div class="border rounded p-2 cursor-pointer hover-shadow" data-icon="${iconName}">
                        <i class="bi ${iconName} fs-4 d-block"></i>
                        <small class="text-truncate d-block mt-1">${iconName.replace('bi-', '')}</small>
                    </div>
                `;
                iconListContainer.appendChild(iconElement);
            });
        }

        // 2. Fungsi untuk memilih ikon
        iconListContainer.addEventListener('click', function (e) {
            const selectedDiv = e.target.closest('[data-icon]');
            if (selectedDiv) {
                const iconName = selectedDiv.getAttribute('data-icon');
                iconInput.value = iconName;
                updatePreview(iconName);
                iconSelectorModal.hide();
            }
        });

        // 3. Fungsi Live Preview
        function updatePreview(iconName) {
            if (iconPreview) {
                iconPreview.className = `bi ${iconName} fs-3 text-primary`;
            }
        }

        // Update preview saat input manual
        iconInput.addEventListener('input', function () {
            updatePreview(this.value);
        });

        // Inisialisasi preview awal
        updatePreview(iconInput.value);

        // 4. Fungsi Pencarian (Search)
        iconSearchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const filteredIcons = allIcons.filter(icon => icon.includes(query));
            renderIcons(filteredIcons);
        });

        // Tampilkan semua ikon saat modal dibuka pertama kali
        iconSelectorModal._element.addEventListener('shown.bs.modal', function () {
            renderIcons(allIcons);
        });

        // CSS sederhana untuk hover (karena kita tidak boleh menggunakan file CSS tambahan)
        const style = document.createElement('style');
        style.innerHTML = `
            .icon-item [data-icon]:hover {
                background-color: var(--bs-light);
                cursor: pointer;
            }
            .hover-shadow:hover {
                 box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
            }
        `;
        document.head.appendChild(style);

    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>