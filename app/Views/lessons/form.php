<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Form materi</span>
            <h2 class="fw-bold mb-2"><?= esc($title) ?></h2>
            <p class="text-muted mb-0">Kursus: <?= esc($course['title']) ?></p>
        </div>
        <a href="<?= site_url('courses/' . $course['id'] . '/lessons') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <form action="<?= esc($action) ?>" method="post">
            <?= csrf_field() ?>
            <?php if ($method === 'put') : ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>
            <div class="row">
                <div class="col-md-9 mb-3">
                    <label class="form-label">Judul Materi</label>
                    <input type="text" name="title" value="<?= esc(old('title', $lesson['title'] ?? '')) ?>" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Urutan</label>
                    <input type="number" min="1" name="order_no" value="<?= esc(old('order_no', $lesson['order_no'] ?? 1)) ?>" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi Materi</label>
                <textarea name="content" rows="6" class="form-control" required><?= esc(old('content', $lesson['content'] ?? '')) ?></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label">URL Video</label>
                <input type="url" name="video_url" value="<?= esc(old('video_url', $lesson['video_url'] ?? '')) ?>" class="form-control" placeholder="Opsional">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Simpan Materi</button>
                <a href="<?= site_url('courses/' . $course['id'] . '/lessons') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
