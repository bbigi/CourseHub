<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container auth-shell py-4">
    <div class="card content-card auth-card border-0 w-100">
        <div class="row g-0 auth-panel">
            <div class="col-lg-5 auth-visual p-4 p-lg-5 d-flex flex-column justify-content-between">
                <div>
                     <div class="brand-mark">
    <img src="<?= base_url('assets/img/logo-coursehub.png') ?>" alt="CourseHub logo"></div>
                    <span class="badge rounded-pill text-bg-light text-primary mb-3">Daftar siswa</span>
                    <h2 class="fw-bold display-6 mb-3">Mulai perjalanan belajar Anda bersama CourseHub.</h2>
                    <p class="opacity-75">Buat akun siswa untuk mendaftar kursus, mengakses materi, dan melacak progres pembelajaran secara berkala.</p>
                </div>
                <div>
                    <div class="auth-bullet">
                        <div class="fw-semibold">Belajar terstruktur</div>
                        <div class="small opacity-75">Materi tersusun berdasarkan urutan belajar dan dapat dilengkapi tautan video.</div>
                    </div>
                    <div class="auth-bullet">
                        <div class="fw-semibold">Progress tercatat</div>
                        <div class="small opacity-75">Siswa dapat memperbarui progres untuk memudahkan monitoring oleh instruktur.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 bg-white p-4 p-lg-5 d-flex align-items-center">
                <div class="w-100">
                    <div class="mb-4">
                        <h3 class="fw-bold mb-1">Daftar Akun Siswa</h3>
                        <p class="text-muted mb-0">Lengkapi form berikut untuk membuat akun baru.</p>
                    </div>
                    <form action="<?= site_url('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" value="<?= esc(old('name')) ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= esc(old('email')) ?>" class="form-control" placeholder="Masukkan email aktif" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Daftar Sekarang</button>
                    </form>
                    <div class="text-center mt-4">
                        <span class="text-muted">Sudah punya akun?</span>
                        <a href="<?= site_url('login') ?>" class="fw-semibold"> Login di sini</a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?= site_url('/') ?>" class="small text-muted"><i class="bi bi-arrow-left me-1"></i>Kembali ke landing page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
