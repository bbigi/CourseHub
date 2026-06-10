<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Form user</span>
            <h2 class="fw-bold mb-2"><?= esc($title) ?></h2>
            <p class="text-muted mb-0">Atur informasi akun pengguna, role, dan status aktif.</p>
        </div>
        <a href="<?= site_url('users') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <form action="<?= esc($action) ?>" method="post">
            <?= csrf_field() ?>
            <?php if ($method === 'put') : ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="<?= esc(old('name', $user['name'] ?? '')) ?>" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Password <?= $user ? '(kosongkan jika tidak diubah)' : '' ?></label>
                    <input type="password" name="password" class="form-control" <?= $user ? '' : 'required' ?>>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Role</label>
                    <?php $selectedRole = old('role', $user['role'] ?? 'siswa'); ?>
                    <select name="role" class="form-select" required>
                        <?php foreach (['admin', 'instruktur', 'siswa'] as $role) : ?>
                            <option value="<?= esc($role) ?>" <?= $selectedRole === $role ? 'selected' : '' ?>><?= esc(ucfirst($role)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-label">Status</label>
                    <?php $selectedStatus = (int) old('is_active', $user['is_active'] ?? 1); ?>
                    <select name="is_active" class="form-select" required>
                        <option value="1" <?= $selectedStatus === 1 ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= $selectedStatus === 0 ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Simpan User</button>
                <a href="<?= site_url('users') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
