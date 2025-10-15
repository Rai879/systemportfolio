<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Why Choose Us</h2>
        <p class="mb-0">Edit alasan memilih perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/why-choose-us') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/why-choose-us/update/' . $item['id']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= old('title', $item['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="3" 
                          required><?= old('description', $item['description']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="icon" name="icon" 
                               value="<?= old('icon', $item['icon']) ?>" required>
                        <span class="input-group-text">
                            <i class="bi <?= $item['icon'] ?>" id="icon-preview"></i>
                        </span>
                    </div>
                    <div class="form-text">Gunakan Bootstrap Icons</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                    <select class="form-select" id="color" name="color" required>
                        <option value="">Pilih Warna</option>
                        <?php foreach($colorOptions as $value => $label): ?>
                            <option value="<?= $value ?>" <?= old('color', $item['color']) == $value ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Urutan</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                       value="<?= old('sort_order', $item['sort_order']) ?>">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/why-choose-us') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview icon
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        
        iconInput.addEventListener('input', function() {
            if (iconPreview) {
                iconPreview.className = 'bi ' + this.value;
            }
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>