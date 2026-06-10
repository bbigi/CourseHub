<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container auth-shell py-4">
    <div class="card content-card auth-card border-0 w-100">
        <div class="row g-0 auth-panel">
            <div class="col-lg-5 auth-visual p-4 p-lg-5 d-flex flex-column justify-content-between">
                <div>
                     <div class="brand-mark">
    <img src="<?= base_url('assets/img/logo-coursehub.png') ?>" alt="CourseHub logo"></div>
                    <span class="badge rounded-pill text-bg-light text-primary mb-3">Welcome back</span>
                    <h2 class="fw-bold display-6 mb-3">Masuk ke dashboard CourseHub.</h2>
                    <p class="opacity-75">Kelola kursus, materi, user, dan progres belajar dengan antarmuka baru yang lebih modern, lembut, dan profesional.</p>
                </div>
                <div>
                    <div class="auth-bullet">
                        <div class="fw-semibold">Admin & Instruktur</div>
                        <div class="small opacity-75">Kelola data kursus, materi, enrolmen, dan akun pengguna.</div>
                    </div>
                    <div class="auth-bullet">
                        <div class="fw-semibold">Siswa</div>
                        <div class="small opacity-75">Daftar kursus, lihat materi, dan update progres belajar.</div>
                    </div>
                    <div class="small opacity-75 mt-4">
                        Demo akun:<br>
                        admin@course.test / password123<br>
                        instruktur@course.test / password123<br>
                        siswa@course.test / password123
                    </div>
                </div>
            </div>
            <div class="col-lg-7 bg-white p-4 p-lg-5 d-flex align-items-center">
                <div class="w-100">
                    <div class="mb-4">
                        <h3 class="fw-bold mb-1">Login</h3>
                        <p class="text-muted mb-0">Silakan masuk untuk mengakses sistem manajemen kursus online.</p>
                    </div>
                    <form action="<?= site_url('login') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="<?= esc(old('email')) ?>" class="form-control border-start-0" placeholder="Masukkan email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Masuk ke Dashboard</button>
                    </form>
                    <div class="text-center mt-4">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="<?= site_url('register') ?>" class="fw-semibold"> Daftar sebagai siswa</a>
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
