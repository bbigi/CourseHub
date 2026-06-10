<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="course-cover mb-4" style="background-image: url('<?= esc($course['thumbnail'] ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80') ?>');">
            <div class="course-cover__content">
                <div class="d-flex gap-2 flex-wrap mb-3">
                    <span class="badge badge-soft text-white bg-primary border-0"><?= esc($course['category']) ?></span>
                    <span class="badge badge-soft text-white bg-dark bg-opacity-25 border-0"><?= esc(ucfirst($course['level'])) ?></span>
                </div>
                <h2 class="fw-bold mb-2"><?= esc($course['title']) ?></h2>
                <p class="mb-3 opacity-75">Instruktur: <?= esc($course['instructor_name'] ?? '-') ?> • Status: <?= esc(ucfirst($course['status'])) ?></p>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge rounded-pill text-bg-light text-primary">Harga: Rp<?= number_format((float) $course['price'], 0, ',', '.') ?></span>
                    <a href="<?= site_url('courses') ?>" class="btn btn-sm btn-light">Kembali</a>
                </div>
            </div>
        </div>

        <div class="content-card mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Deskripsi Kursus</h5>
                <p class="text-muted mb-0" style="line-height: 1.8;"><?= esc($course['description']) ?></p>
            </div>
        </div>

        <div class="content-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Daftar Materi</h5>
                        <p class="text-muted mb-0">Pelajari materi sesuai urutan yang sudah disusun.</p>
                    </div>
                </div>
                <?php foreach ($lessons as $lesson) : ?>
                    <div class="module-item">
                        <div class="d-flex justify-content-between align-items-start gap-2 flex-wrap mb-2">
                            <div class="fw-semibold"><?= esc($lesson['order_no']) ?>. <?= esc($lesson['title']) ?></div>
                            <?php if ($lesson['video_url']) : ?>
                                <a href="<?= esc($lesson['video_url']) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Lihat Video</a>
                            <?php endif; ?>
                        </div>
                        <div class="text-muted small" style="line-height: 1.8;"><?= esc(character_limiter($lesson['content'], 180)) ?></div>
                    </div>
                <?php endforeach; ?>
                <?php if ($lessons === []) : ?>
                    <p class="text-muted mb-0">Belum ada materi pada kursus ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Aksi</h5>
                <?php if (session()->get('role') === 'siswa') : ?>
                    <?php if ($enrollment) : ?>
                        <p class="text-muted mb-2">Anda sudah terdaftar pada kursus ini.</p>
                        <div class="small text-muted mb-2">Progress Belajar</div>
                        <div class="progress mb-3"><div class="progress-bar" style="width: <?= (int) $enrollment['progress'] ?>%;"><?= (int) $enrollment['progress'] ?>%</div></div>
                        <a href="<?= site_url('enrollments') ?>" class="btn btn-outline-primary w-100">Lihat Progress</a>
                    <?php else : ?>
                        <p class="text-muted">Klik tombol berikut untuk mendaftar ke kursus ini.</p>
                        <form action="<?= site_url('courses/' . $course['id'] . '/enroll') ?>" method="post">
                            <?= csrf_field() ?>
                            <button class="btn btn-primary w-100" type="submit">Daftar Kursus</button>
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-muted">Kelola materi dan ubah detail kursus dari panel berikut.</p>
                    <a href="<?= site_url('courses/' . $course['id'] . '/lessons') ?>" class="btn btn-primary w-100 mb-2">Kelola Materi</a>
                    <a href="<?= site_url('courses/' . $course['id'] . '/edit') ?>" class="btn btn-outline-warning w-100">Edit Kursus</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="content-card">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Informasi Singkat</h6>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Kategori</span>
                    <span class="fw-semibold"><?= esc($course['category']) ?></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Level</span>
                    <span class="fw-semibold text-capitalize"><?= esc($course['level']) ?></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Status</span>
                    <span class="fw-semibold text-capitalize"><?= esc($course['status']) ?></span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted">Instruktur</span>
                    <span class="fw-semibold"><?= esc($course['instructor_name'] ?? '-') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
