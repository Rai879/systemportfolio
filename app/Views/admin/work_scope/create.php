<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Tambah Work Scope</h2>
        <p class="mb-0">Tambahkan informasi cakupan pekerjaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/work-scope') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/work-scope/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="<?= old('title') ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Subjudul</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" 
                           value="<?= old('subtitle') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" 
                          required><?= old('description') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Features</label>
                <div id="features-container">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="features[]" placeholder="Masukkan fitur cakupan pekerjaan">
                        <button type="button" class="btn btn-outline-danger remove-feature">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
                    <i class="bi bi-plus me-1"></i> Tambah Feature
                </button>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Simpan
                </button>
                <a href="<?= base_url('/admin/work-scope') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add feature field
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            const newFeature = document.createElement('div');
            newFeature.className = 'input-group mb-2';
            newFeature.innerHTML = `
                <input type="text" class="form-control" name="features[]" placeholder="Masukkan fitur cakupan pekerjaan">
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            container.appendChild(newFeature);
        });

        // Remove feature field
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>