<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Monitoring belajar</span>
            <h2 class="fw-bold mb-2">Enrolmen & Progress</h2>
            <p class="text-muted mb-0">Pantau data pendaftaran kursus dan perkembangan belajar siswa dari satu halaman.</p>
        </div>
        <a href="<?= site_url('courses') ?>" class="btn btn-primary">Lihat Kursus</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Siswa</th><th>Kursus</th><th>Status</th><th>Progress</th><th>Tanggal Daftar</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                <?php foreach ($enrollments as $enrollment) : ?>
                    <tr>
                        <td class="fw-semibold"><?= esc($enrollment['student_name'] ?? '-') ?></td>
                        <td><?= esc($enrollment['course_title'] ?? '-') ?></td>
                        <td><span class="badge badge-soft badge-soft-success"><?= esc(ucfirst($enrollment['status'])) ?></span></td>
                        <td style="min-width: 200px;">
                            <div class="progress"><div class="progress-bar" style="width: <?= (int) $enrollment['progress'] ?>%;"><?= (int) $enrollment['progress'] ?>%</div></div>
                        </td>
                        <td><?= esc($enrollment['enrolled_at']) ?></td>
                        <td class="text-end">
                            <?php if (session()->get('role') === 'siswa') : ?>
                                <form action="<?= site_url('enrollments/' . $enrollment['id'] . '/progress') ?>" method="post" class="d-inline-flex gap-2">
                                    <?= csrf_field() ?>
                                    <input type="number" min="0" max="100" name="progress" value="<?= (int) $enrollment['progress'] ?>" class="form-control form-control-sm" style="width: 90px; min-height: 40px;">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Update</button>
                                </form>
                            <?php else : ?>
                                <span class="text-muted small">Monitoring</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($enrollments === []) : ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data enrolmen.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
