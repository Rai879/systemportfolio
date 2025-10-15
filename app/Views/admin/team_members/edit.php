<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Team Member</h2>
        <p class="mb-0">Edit data anggota tim perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/team-members') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($teamMember['photo']): ?>
            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label>
                <div>
                    <img src="<?= base_url('uploads/team/' . $teamMember['photo']) ?>" 
                         alt="Current Photo" class="img-thumbnail rounded-circle" style="max-height: 200px;">
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/team-members/update/' . $teamMember['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= old('name', $teamMember['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Posisi <span class="text-danger">*</span></label>
                <select class="form-select" id="position" name="position" required>
                    <option value="">Pilih Posisi</option>
                    <?php foreach($positionOptions as $value => $label): ?>
                        <option value="<?= $value ?>" <?= old('position', $teamMember['position']) == $value ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" 
                           value="<?= old('sort_order', $teamMember['sort_order']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">Foto Baru</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <div class="form-text">Kosongkan jika tidak ingin mengubah foto</div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                           <?= $teamMember['is_active'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/team-members') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>