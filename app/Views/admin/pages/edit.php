<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Halaman: <?= esc($page['title']) ?></h2>
        <p class="mb-0">Ubah konten halaman sesuai kebutuhan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/pages') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('/admin/pages/update/' . $page['id']) ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label class="form-label">Slug / URL (Tidak dapat diubah)</label>
                <input type="text" class="form-control" value="<?= esc($page['slug']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= old('title', $page['title']) ?>" required>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Konten HTML <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="15" required><?= old('content', $page['content']) ?></textarea>
                <div class="form-text">Anda dapat memasukkan sintaks HTML pada form ini untuk mengatur gaya tulisan.</div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
