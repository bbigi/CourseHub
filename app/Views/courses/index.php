<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Manajemen kursus</span>
            <h2 class="fw-bold mb-2">Data Kursus</h2>
            <p class="text-muted mb-0">Kelola data kursus, cari berdasarkan kata kunci, lalu akses detail dan materi pembelajaran dengan tampilan yang lebih bersih.</p>
        </div>
        <?php if (in_array(session()->get('role'), ['admin', 'instruktur'], true)) : ?>
            <a href="<?= site_url('courses/new') ?>" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Kursus</a>
        <?php endif; ?>
    </div>
</div>

<div class="content-card mb-4">
    <div class="card-body">
        <form method="get" action="<?= site_url('courses') ?>" class="row g-3 align-items-end">
            <div class="col-md-10">
                <label class="form-label">Pencarian kursus</label>
                <input type="text" name="q" value="<?= esc($keyword) ?>" class="form-control" placeholder="Cari judul, kategori, atau level kursus...">
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search me-1"></i>Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kursus</th>
                        <th>Level</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Instruktur</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($courses as $course) : ?>
                    <tr>
                        <td>
                            <div class="fw-semibold"><?= esc($course['title']) ?></div>
                            <div class="small text-muted"><?= esc($course['category']) ?></div>
                        </td>
                        <td><span class="badge badge-soft"><?= esc(ucfirst($course['level'])) ?></span></td>
                        <td class="fw-semibold text-primary">Rp<?= number_format((float) $course['price'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= $course['status'] === 'published' ? 'badge-soft badge-soft-success' : ($course['status'] === 'draft' ? 'badge-soft badge-soft-warning' : 'badge-soft badge-soft-muted') ?>">
                                <?= esc(ucfirst($course['status'])) ?>
                            </span>
                        </td>
                        <td><?= esc($course['instructor_name'] ?? '-') ?></td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                <a href="<?= site_url('courses/' . $course['id']) ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                <?php if (in_array(session()->get('role'), ['admin', 'instruktur'], true)) : ?>
                                    <a href="<?= site_url('courses/' . $course['id'] . '/lessons') ?>" class="btn btn-sm btn-outline-secondary">Materi</a>
                                    <a href="<?= site_url('courses/' . $course['id'] . '/edit') ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="<?= site_url('courses/' . $course['id']) ?>" method="post" onsubmit="return confirm('Hapus kursus ini?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($courses === []) : ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Data kursus belum tersedia.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
