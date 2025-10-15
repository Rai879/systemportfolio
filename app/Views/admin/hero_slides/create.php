<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Tambah Hero Slide</h2>
        <p class="mb-0">Buat slide baru untuk bagian hero website</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/hero-slides') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/hero-slides/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= old('title') ?>" required>
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subjudul</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" 
                       value="<?= old('subtitle') ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="button_text" class="form-label">Teks Tombol</label>
                    <input type="text" class="form-control" id="button_text" name="button_text" 
                           value="<?= old('button_text') ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="button_link" class="form-label">Link Tombol</label>
                    <input type="url" class="form-control" id="button_link" name="button_link" 
                           value="<?= old('button_link') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                           value="<?= old('sort_order', 0) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Gambar <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Simpan
                </button>
                <a href="<?= base_url('/admin/hero-slides') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>