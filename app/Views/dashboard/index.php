<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 position-relative">
        <div>
            <span class="badge badge-soft mb-3">Ringkasan sistem</span>
            <h2 class="fw-bold mb-2">Dashboard CourseHub</h2>
            <p class="text-muted mb-0" style="max-width: 700px;">Pantau statistik utama, akses cepat ke modul sistem, dan lihat daftar kursus terbaru dari satu halaman yang lebih rapi.</p>
        </div>
        <a href="<?= site_url('courses') ?>" class="btn btn-primary"><i class="bi bi-journal-plus me-2"></i>Kelola Kursus</a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="metric-card h-100">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted mb-2">Total Kursus</div>
                    <div class="quick-stat-number"><?= esc($stats['courses']) ?></div>
                    <div class="small text-muted">Data kursus terdaftar</div>
                </div>
                <div class="metric-icon"><i class="bi bi-collection-play-fill"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card h-100">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted mb-2">Total Materi</div>
                    <div class="quick-stat-number"><?= esc($stats['lessons']) ?></div>
                    <div class="small text-muted">Materi pembelajaran</div>
                </div>
                <div class="metric-icon"><i class="bi bi-journal-code"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card h-100">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted mb-2">Total Enrolmen</div>
                    <div class="quick-stat-number"><?= esc($stats['enrollments']) ?></div>
                    <div class="small text-muted">Peserta terdaftar</div>
                </div>
                <div class="metric-icon"><i class="bi bi-graph-up-arrow"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card h-100">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted mb-2">Total User</div>
                    <div class="quick-stat-number"><?= esc($stats['users']) ?></div>
                    <div class="small text-muted">Akun di sistem</div>
                </div>
                <div class="metric-icon"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="content-card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h5 class="fw-bold mb-1">Akses cepat</h5>
                <p class="text-muted mb-0">Gunakan pintasan berikut untuk membuka modul utama.</p>
            </div>
        </div>
        <div class="quick-actions">
            <a href="<?= site_url('courses') ?>" class="action-tile">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="metric-icon"><i class="bi bi-journal-richtext"></i></div>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="fw-bold mb-1">Data Kursus</div>
                <div class="text-muted small">Lihat, tambah, edit, dan hapus kursus.</div>
            </a>
            <a href="<?= site_url('enrollments') ?>" class="action-tile">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="metric-icon"><i class="bi bi-bar-chart-line-fill"></i></div>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <div class="fw-bold mb-1">Monitoring Enrolmen</div>
                <div class="text-muted small">Pantau siswa terdaftar dan progress belajar.</div>
            </a>
            <?php if (session()->get('role') === 'admin') : ?>
                <a href="<?= site_url('users') ?>" class="action-tile">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="metric-icon"><i class="bi bi-person-gear"></i></div>
                        <i class="bi bi-arrow-right"></i>
                    </div>
                    <div class="fw-bold mb-1">Manajemen User</div>
                    <div class="text-muted small">Atur akun admin, instruktur, dan siswa.</div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h5 class="fw-bold mb-1">Kursus Terbaru</h5>
                <p class="text-muted mb-0">Daftar kursus terbaru yang telah tersimpan di sistem.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Instruktur</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($latestCourses as $course) : ?>
                        <tr>
                            <td>
                                <div class="fw-semibold"><?= esc($course['title']) ?></div>
                                <div class="small text-muted">Slug: <?= esc($course['slug']) ?></div>
                            </td>
                            <td><?= esc($course['category']) ?></td>
                            <td><span class="badge badge-soft"><?= esc(ucfirst($course['level'])) ?></span></td>
                            <td>
                                <span class="badge <?= $course['status'] === 'published' ? 'badge-soft badge-soft-success' : ($course['status'] === 'draft' ? 'badge-soft badge-soft-warning' : 'badge-soft badge-soft-muted') ?>">
                                    <?= esc(ucfirst($course['status'])) ?>
                                </span>
                            </td>
                            <td><?= esc($course['instructor_name'] ?? '-') ?></td>
                            <td class="text-end"><a href="<?= site_url('courses/' . $course['id']) ?>" class="btn btn-sm btn-outline-primary">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($latestCourses === []) : ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data kursus.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
