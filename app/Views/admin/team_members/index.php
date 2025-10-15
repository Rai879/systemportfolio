<?= $this->extend('admin/templates/header') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Team Members Management</h2>
        <p class="mb-0">Kelola anggota tim perusahaan</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('/admin/team-members/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Member
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($teamMembers) && !empty($teamMembers)): ?>
                        <?php foreach($teamMembers as $index => $member): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if($member['photo']): ?>
                                        <img src="<?= base_url('uploads/team/' . $member['photo']) ?>" 
                                             alt="<?= $member['name'] ?>" class="rounded-circle" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-person text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $member['name'] ?></td>
                                <td><?= $member['position'] ?></td>
                                <td><?= $member['sort_order'] ?></td>
                                <td>
                                    <?php if($member['is_active']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('/admin/team-members/edit/' . $member['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/team-members/toggle-status/' . $member['id']) ?>" 
                                           class="btn btn-sm btn-outline-<?= $member['is_active'] ? 'warning' : 'success' ?>">
                                            <i class="bi bi-<?= $member['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/team-members/delete/' . $member['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus team member ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada team members.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>