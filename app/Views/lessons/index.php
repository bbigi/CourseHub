<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Manajemen materi</span>
            <h2 class="fw-bold mb-2">Materi: <?= esc($course['title']) ?></h2>
            <p class="text-muted mb-0">Atur urutan materi dan isi pembelajaran agar pengalaman belajar lebih terstruktur.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?= site_url('courses/' . $course['id'] . '/lessons/new') ?>" class="btn btn-primary">Tambah Materi</a>
            <a href="<?= site_url('courses') ?>" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Urutan</th><th>Judul</th><th>Ringkasan</th><th>Video</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                <?php foreach ($lessons as $lesson) : ?>
                    <tr>
                        <td><span class="badge badge-soft"><?= esc($lesson['order_no']) ?></span></td>
                        <td class="fw-semibold"><?= esc($lesson['title']) ?></td>
                        <td class="text-muted"><?= esc(character_limiter($lesson['content'], 100)) ?></td>
                        <td><?= $lesson['video_url'] ? '<span class="badge badge-soft badge-soft-success">Tersedia</span>' : '<span class="badge badge-soft badge-soft-muted">Tidak ada</span>' ?></td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="<?= site_url('courses/' . $course['id'] . '/lessons/' . $lesson['id'] . '/edit') ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="<?= site_url('courses/' . $course['id'] . '/lessons/' . $lesson['id']) ?>" method="post" onsubmit="return confirm('Hapus materi ini?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($lessons === []) : ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada materi.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
