<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Pengaturan Situs</h2>
        <p class="mb-0">Kelola pengaturan umum website</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" 
                        data-bs-target="#general" type="button" role="tab">
                    <i class="bi bi-gear me-2"></i> Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="social-tab" data-bs-toggle="tab" 
                        data-bs-target="#social" type="button" role="tab">
                    <i class="bi bi-share me-2"></i> Media Sosial
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="settingsTabsContent">
            <!-- General Settings -->
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                <form action="<?= base_url('/admin/settings/update-general') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="site_name" class="form-label">Nama Situs</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" 
                                   value="<?= old('site_name', $settings['site_name'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="contact_email" class="form-label">Email Kontak</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                   value="<?= old('contact_email', $settings['contact_email'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact_phone" class="form-label">Telepon Kontak</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                   value="<?= old('contact_phone', $settings['contact_phone'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="contact_address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="contact_address" name="contact_address" 
                                   value="<?= old('contact_address', $settings['contact_address'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label">Deskripsi Situs</label>
                        <textarea class="form-control" id="site_description" name="site_description" 
                                  rows="3"><?= old('site_description', $settings['site_description'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i> Simpan Pengaturan Umum
                    </button>
                </form>
            </div>

            <!-- Social Media Settings -->
            <div class="tab-pane fade" id="social" role="tabpanel">
                <form action="<?= base_url('/admin/settings/update-social') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="social_facebook" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control" id="social_facebook" name="social_facebook" 
                                   value="<?= old('social_facebook', $settings['social_facebook'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="social_instagram" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control" id="social_instagram" name="social_instagram" 
                                   value="<?= old('social_instagram', $settings['social_instagram'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="social_twitter" class="form-label">Twitter URL</label>
                            <input type="url" class="form-control" id="social_twitter" name="social_twitter" 
                                   value="<?= old('social_twitter', $settings['social_twitter'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="social_linkedin" class="form-label">LinkedIn URL</label>
                            <input type="url" class="form-control" id="social_linkedin" name="social_linkedin" 
                                   value="<?= old('social_linkedin', $settings['social_linkedin'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="social_youtube" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control" id="social_youtube" name="social_youtube" 
                               value="<?= old('social_youtube', $settings['social_youtube'] ?? '') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i> Simpan Pengaturan Media Sosial
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>