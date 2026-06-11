<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="login-page">
    <div class="login-bg-orb login-orb-1"></div>
    <div class="login-bg-orb login-orb-2"></div>

    <div class="container">
        <div class="login-wrapper">
            <div class="login-card-v2">
                <div class="row g-0 align-items-stretch">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="login-side-panel">
                            <div>
                                <div class="login-logo-box mb-4">
                                    <img src="<?= base_url('assets/img/logo-coursehub.png') ?>" alt="CourseHub logo">
                                </div>

                                <span class="login-badge">CourseHub</span>

                                <h2 class="login-side-title">
                                    Masuk dan lanjutkan pengelolaan kursus.
                                </h2>

                                <p class="login-side-desc">
                                    Kelola kursus, materi, enrolmen, user, dan progress belajar dalam satu sistem yang rapi.
                                </p>
                            </div>

                            <div class="login-feature-list">
                                <div class="login-feature-item">
                                    <div class="login-feature-icon">
                                        <i class="bi bi-journal-richtext"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Manajemen kursus</div>
                                        <small>Kursus dan materi lebih mudah dikelola.</small>
                                    </div>
                                </div>

                                <div class="login-feature-item">
                                    <div class="login-feature-icon">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Progress belajar</div>
                                        <small>Pantau perkembangan siswa secara praktis.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="login-form-panel">
                            <div class="text-center mb-4">
                                <div class="login-logo-mobile mx-auto mb-3">
                                    <img src="<?= base_url('assets/img/logo-coursehub.png') ?>" alt="CourseHub logo">
                                </div>

                                <span class="badge badge-soft mb-3">Welcome back</span>
                                <h3 class="fw-bold mb-2">Login CourseHub</h3>
                                <p class="text-muted mb-0">
                                    Masuk untuk mengakses sistem manajemen kursus online.
                                </p>
                            </div>

                            <form action="<?= site_url('login') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="login-input-group">
                                        <span>
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input
                                            type="email"
                                            name="email"
                                            value="<?= esc(old('email')) ?>"
                                            class="form-control"
                                            placeholder="Masukkan email"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="login-input-group">
                                        <span>
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="Masukkan password"
                                            required
                                        >
                                    </div>
                                </div>

                                <button class="btn btn-primary w-100 login-submit" type="submit">
                                    Masuk ke Dashboard
                                </button>
                            </form>

                            <div class="login-demo-box mt-4">
                                <div class="fw-semibold mb-2">Akun Demo</div>
                                <div class="small text-muted">
                                    Admin: admin@course.test / password123<br>
                                    Instruktur: instruktur@course.test / password123<br>
                                    Siswa: siswa@course.test / password123
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <span class="text-muted">Belum punya akun?</span>
                                <a href="<?= site_url('register') ?>" class="fw-semibold">
                                    Daftar sebagai siswa
                                </a>
                            </div>

                            <div class="text-center mt-3">
                                <a href="<?= site_url('/') ?>" class="small text-muted">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Kembali ke landing page
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>