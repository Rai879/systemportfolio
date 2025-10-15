<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Statistic</h2>
        <p class="mb-0">Edit statistik perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/statistics') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/statistics/update/' . $statistic['id']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="label" name="label" 
                       value="<?= old('label', $statistic['label']) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="value" name="value" 
                           value="<?= old('value', $statistic['value']) ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                           value="<?= old('sort_order', $statistic['sort_order']) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                <select class="form-select" id="icon" name="icon" required>
                    <option value="">Pilih Icon</option>
                    <?php foreach($iconOptions as $value => $label): ?>
                        <option value="<?= $value ?>" <?= old('icon', $statistic['icon']) == $value ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="form-text">Pilih icon yang sesuai dengan statistic</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/statistics') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>