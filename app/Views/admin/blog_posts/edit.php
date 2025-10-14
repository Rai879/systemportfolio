<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Edit Blog Post</h2>
        <p class="mb-0">Edit artikel atau berita</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/blog-posts') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($blogPost['featured_image']): ?>
            <div class="mb-3">
                <label class="form-label">Featured Image Saat Ini</label>
                <div>
                    <img src="<?= base_url('uploads/blog/' . $blogPost['featured_image']) ?>" 
                         alt="Current Image" class="img-thumbnail" style="max-height: 200px;">
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/blog-posts/update/' . $blogPost['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= old('title', $blogPost['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="slug" name="slug" 
                       value="<?= old('slug', $blogPost['slug']) ?>" required>
                <div class="form-text">URL-friendly version of the title</div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach($categories as $value => $label): ?>
                            <option value="<?= $value ?>" <?= old('category', $blogPost['category']) == $value ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="author" name="author" 
                           value="<?= old('author', $blogPost['author']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image Baru</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                <div class="form-text">Kosongkan jika tidak ingin mengubah gambar</div>
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt <span class="text-danger">*</span></label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3" 
                          required><?= old('excerpt', $blogPost['excerpt']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="10" 
                          required><?= old('content', $blogPost['content']) ?></textarea>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" 
                           <?= $blogPost['is_published'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_published">
                        Publikasikan
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update
                </button>
                <a href="<?= base_url('/admin/blog-posts') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('blur', function() {
            if (!slugInput.value) {
                const title = titleInput.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            }
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>