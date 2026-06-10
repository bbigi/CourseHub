<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Admin panel</span>
            <h2 class="fw-bold mb-2">Manajemen User</h2>
            <p class="text-muted mb-0">Kelola akun admin, instruktur, dan siswa dengan tampilan tabel yang lebih rapi.</p>
        </div>
        <a href="<?= site_url('users/new') ?>" class="btn btn-primary">Tambah User</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="fw-semibold"><?= esc($user['name']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><span class="badge badge-soft"><?= esc(ucfirst($user['role'])) ?></span></td>
                        <td>
                            <span class="badge <?= (int) $user['is_active'] === 1 ? 'badge-soft badge-soft-success' : 'badge-soft badge-soft-muted' ?>">
                                <?= (int) $user['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="<?= site_url('users/' . $user['id']) ?>" method="post" onsubmit="return confirm('Hapus user ini?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($users === []) : ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada user terdaftar.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
