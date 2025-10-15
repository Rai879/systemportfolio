<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Feature</h2>
        <p class="mb-0">Edit fitur unggulan perusahaan</p>
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
        <form action="<?= base_url('/admin/features/update/' . $feature['id']) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= session('errors.title') ? 'is-invalid' : '' ?>" id="title" name="title" 
                       value="<?= old('title', $feature['title']) ?>" required>
                <?php if (session('errors.title')): ?>
                    <div class="invalid-feedback"><?= session('errors.title') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>" id="description" name="description" rows="3" 
                          required><?= old('description', $feature['description']) ?></textarea>
                <?php if (session('errors.description')): ?>
                    <div class="invalid-feedback"><?= session('errors.description') ?></div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control <?= session('errors.icon') ? 'is-invalid' : '' ?>"
                            id="icon" name="icon" value="<?= old('icon', $feature['icon']) ?>" required placeholder="bi-star-fill">
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
                        <i id="icon-preview" class="bi <?= old('icon', $feature['icon']) ?> fs-3 text-primary"></i>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                    <select class="form-select <?= session('errors.color') ? 'is-invalid' : '' ?>" id="color"
                        name="color" required>
                        <option value="">Pilih Warna</option>
                        <?php
                        // Definisikan colorOptions agar tersedia di view
                        $colorOptions = [
                            'primary' => 'Primary (Biru)',
                            'secondary' => 'Secondary (Abu-abu)',
                            'success' => 'Success (Hijau)',
                            'danger' => 'Danger (Merah)',
                            'warning' => 'Warning (Kuning)',
                            'info' => 'Info (Cyan)',
                            'dark' => 'Dark (Hitam)'
                        ];
                        // Tentukan nilai terpilih: gunakan old() jika ada error, jika tidak, gunakan nilai $feature
                        $selectedColor = old('color', $feature['color']);
                        ?>
                        <?php foreach ($colorOptions as $value => $label): ?>
                            <option value="<?= $value ?>" <?= $selectedColor == $value ? 'selected' : '' ?>>
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
                           value="<?= old('sort_order', $feature['sort_order']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check">
                        <?php 
                        // Tentukan status aktif: gunakan old() atau nilai $feature
                        $isActive = (bool)old('is_active', $feature['is_active']);
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
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/features') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="iconSelectorModal" tabindex="-1" aria-labelledby="iconSelectorModalLabel" aria-hidden="true">
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
        // Pastikan elemen ini ada sebelum mencoba mengaksesnya
        const iconListContainer = document.getElementById('icon-list');
        const iconSearchInput = document.getElementById('icon-search');
        const iconSelectorModalElement = document.getElementById('iconSelectorModal');
        const iconSelectorModal = new bootstrap.Modal(iconSelectorModalElement);

        // Data ikon Bootstrap (Ditingkatkan)
        const allIcons = [
            'bi-house-door', 'bi-house-door-fill', 'bi-compass', 'bi-map', 'bi-pin-map', 'bi-pin-map-fill',
            'bi-gear', 'bi-gear-fill', 'bi-tools', 'bi-sliders', 'bi-sliders2', 'bi-wrench',
            'bi-telephone', 'bi-telephone-fill', 'bi-envelope', 'bi-envelope-fill', 'bi-chat-dots',
            'bi-briefcase', 'bi-briefcase-fill', 'bi-wallet', 'bi-wallet2', 'bi-credit-card',
            'bi-bag', 'bi-bag-fill', 'bi-cart', 'bi-cart-fill', 'bi-basket', 'bi-basket-fill',
            'bi-bar-chart', 'bi-bar-chart-fill', 'bi-pie-chart', 'bi-pie-chart-fill',
            'bi-laptop', 'bi-phone', 'bi-tablet', 'bi-display', 'bi-cpu', 'bi-database',
            'bi-wifi', 'bi-cloud', 'bi-cloud-upload', 'bi-cloud-download', 'bi-router',
            'bi-shield-check', 'bi-shield-fill-check', 'bi-shield-lock', 'bi-lock',
            'bi-camera', 'bi-camera-fill', 'bi-image', 'bi-images', 'bi-film', 'bi-play-circle',
            'bi-file-earmark', 'bi-file-earmark-text', 'bi-file-earmark-pdf', 'bi-folder',
            'bi-calendar', 'bi-calendar-check', 'bi-calendar-event', 'bi-clock',
            'bi-people', 'bi-people-fill', 'bi-person', 'bi-person-fill', 'bi-person-badge',
            'bi-bell', 'bi-bell-fill', 'bi-check-circle', 'bi-check-circle-fill',
            'bi-arrow-repeat', 'bi-download', 'bi-upload', 'bi-share', 'bi-send',
            'bi-heart', 'bi-heart-fill', 'bi-heart-pulse', 'bi-hospital', 'bi-bandaid',
            'bi-truck', 'bi-box-seam', 'bi-box', 'bi-box-arrow-right', 'bi-airplane',
            'bi-lightning', 'bi-lightning-fill', 'bi-gem', 'bi-award', 'bi-trophy',
            'bi-clipboard', 'bi-clipboard-check', 'bi-list-task', 'bi-list-check',
            'bi-globe', 'bi-globe2', 'bi-infinity', 'bi-bookmark', 'bi-flag',
            // Pastikan array ini lengkap atau ambil dari sumber eksternal jika memungkinkan
        ];

        // --- FUNGSI UTAMA ICON SELECTOR ---

        // 1. Fungsi untuk menampilkan daftar ikon
        function renderIcons(icons) {
            if (!iconListContainer) return; // Safety check
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
        if (iconListContainer) {
            iconListContainer.addEventListener('click', function (e) {
                const selectedDiv = e.target.closest('[data-icon]');
                if (selectedDiv) {
                    const iconName = selectedDiv.getAttribute('data-icon');
                    iconInput.value = iconName;
                    updatePreview(iconName);
                    iconSelectorModal.hide();
                }
            });
        }

        // 3. Fungsi Live Preview
        function updatePreview(iconName) {
            if (iconPreview) {
                // Gunakan nilai dari input. Jika kosong, gunakan 'bi-question-square'
                const finalIcon = iconName || 'bi-question-square'; 
                iconPreview.className = `bi ${finalIcon} fs-3 text-primary`;
            }
        }

        // Update preview saat input manual
        iconInput.addEventListener('input', function () {
            updatePreview(this.value);
        });

        // Inisialisasi preview awal menggunakan data yang sudah ada
        updatePreview(iconInput.value);

        // 4. Fungsi Pencarian (Search)
        if (iconSearchInput) {
            iconSearchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase();
                const filteredIcons = allIcons.filter(icon => icon.includes(query));
                renderIcons(filteredIcons);
            });
        }

        // Tampilkan semua ikon saat modal dibuka
        iconSelectorModalElement.addEventListener('shown.bs.modal', function () {
            renderIcons(allIcons);
            // Kosongkan kolom pencarian setiap kali modal dibuka
            if (iconSearchInput) iconSearchInput.value = ''; 
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