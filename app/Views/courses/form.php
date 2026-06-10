<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="page-hero content-card">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <span class="badge badge-soft mb-3">Form kursus</span>
            <h2 class="fw-bold mb-2"><?= esc($title) ?></h2>
            <p class="text-muted mb-0">Lengkapi informasi kursus secara lengkap agar data lebih rapi dan mudah dipahami siswa.</p>
        </div>
        <a href="<?= site_url('courses') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body">
        <form action="<?= esc($action) ?>" method="post">
            <?= csrf_field() ?>
            <?php if ($method === 'put') : ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Judul Kursus</label>
                    <input type="text" name="title" value="<?= esc(old('title', $course['title'] ?? '')) ?>" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" value="<?= esc(old('category', $course['category'] ?? '')) ?>" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="5" class="form-control" required><?= esc(old('description', $course['description'] ?? '')) ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Level</label>
                    <?php $selectedLevel = old('level', $course['level'] ?? 'pemula'); ?>
                    <select name="level" class="form-select" required>
                        <?php foreach (['pemula', 'menengah', 'lanjutan'] as $level) : ?>
                            <option value="<?= esc($level) ?>" <?= $selectedLevel === $level ? 'selected' : '' ?>><?= esc(ucfirst($level)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" step="0.01" min="0" name="price" value="<?= esc(old('price', $course['price'] ?? 0)) ?>" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <?php $selectedStatus = old('status', $course['status'] ?? 'draft'); ?>
                    <select name="status" class="form-select" required>
                        <?php foreach (['draft', 'published', 'archived'] as $status) : ?>
                            <option value="<?= esc($status) ?>" <?= $selectedStatus === $status ? 'selected' : '' ?>><?= esc(ucfirst($status)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Instruktur</label>
                    <?php $selectedInstructor = (int) old('instructor_id', $course['instructor_id'] ?? session()->get('user_id')); ?>
                    <select name="instructor_id" class="form-select" required>
                        <?php foreach ($instructors as $instructor) : ?>
                            <option value="<?= esc($instructor['id']) ?>" <?= $selectedInstructor === (int) $instructor['id'] ? 'selected' : '' ?>><?= esc($instructor['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">URL Thumbnail</label>
                <input type="url" name="thumbnail" value="<?= esc(old('thumbnail', $course['thumbnail'] ?? '')) ?>" class="form-control" placeholder="https://...">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Simpan Kursus</button>
                <a href="<?= site_url('courses') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
