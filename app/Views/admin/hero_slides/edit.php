<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Hero Slide</h2>
        <p class="mb-0">Edit slide untuk bagian hero website</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/hero-slides') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($slide['image']): ?>
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label>
                <div>
                    <img src="<?= base_url('uploads/hero/' . $slide['image']) ?>" 
                         alt="Current Image" class="img-thumbnail" style="max-height: 200px;">
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/hero-slides/update/' . $slide['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= old('title', $slide['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subjudul</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" 
                       value="<?= old('subtitle', $slide['subtitle']) ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $slide['description']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="button_text" class="form-label">Teks Tombol</label>
                    <input type="text" class="form-control" id="button_text" name="button_text" 
                           value="<?= old('button_text', $slide['button_text']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="button_link" class="form-label">Link Tombol</label>
                    <input type="url" class="form-control" id="button_link" name="button_link" 
                           value="<?= old('button_link', $slide['button_link']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                           value="<?= old('sort_order', $slide['sort_order']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Gambar Baru</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <div class="form-text">Kosongkan jika tidak ingin mengubah gambar</div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                           <?= $slide['is_active'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/hero-slides') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>