<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'CourseHub') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css') ?>?v=parallax-fix-2" rel="stylesheet">
</head>
<body>
<?php
    $uri = service('uri');
    $path = trim($uri->getPath(), '/');
    $role = session()->get('role');
    $isLoggedIn = (bool) session()->get('isLoggedIn');
    $pageTitle = $title ?? 'CourseHub';

    $navItems = [
        ['path' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'bi-grid-1x2-fill'],
        ['path' => 'courses', 'label' => 'Kursus', 'icon' => 'bi-journal-richtext'],
        ['path' => 'enrollments', 'label' => 'Enrolmen', 'icon' => 'bi-bar-chart-line-fill'],
    ];
    if ($role === 'admin') {
        $navItems[] = ['path' => 'users', 'label' => 'User', 'icon' => 'bi-people-fill'];
    }
?>

<?php if ($isLoggedIn) : ?>
    <div class="container-fluid app-shell">
        <div class="row">
            <aside class="col-12 col-lg-auto app-sidebar px-0">
                <div class="app-sidebar__inner">
                    <div class="brand-wrap">
                        <div class="brand-mark">CH</div>
                        <div class="brand-copy">
                            <div class="fw-bold fs-5">CourseHub</div>
                            <small>Sistem kursus online modern</small>
                        </div>
                    </div>

                    <div class="sidebar-label">Navigasi Sistem</div>
                    <nav class="nav flex-column app-nav mb-3">
                        <?php foreach ($navItems as $item) : ?>
                            <?php $isActive = $path === $item['path'] || str_starts_with($path, $item['path'] . '/'); ?>
                            <a class="nav-link <?= $isActive ? 'active' : '' ?>" href="<?= site_url($item['path']) ?>">
                                <i class="bi <?= esc($item['icon']) ?>"></i>
                                <span><?= esc($item['label']) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </nav>

                    <div class="sidebar-profile">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar">
                                <?= esc(strtoupper(substr((string) session()->get('name'), 0, 1))) ?>
                            </div>
                            <div>
                                <div class="fw-semibold text-white"><?= esc(session()->get('name')) ?></div>
                                <div class="small text-white-50 text-capitalize"><?= esc($role) ?></div>
                            </div>
                        </div>
                        <div class="small text-white-50 mb-3">Anda sedang masuk ke area manajemen kursus, materi, user, dan progress belajar.</div>
                        <form action="<?= site_url('logout') ?>" method="post">
                            <?= csrf_field() ?>
                            <button class="btn btn-outline-light btn-sm w-100" type="submit">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <main class="col app-main">
                <div class="topbar glass-card">
                    <div>
                        <div class="fw-bold fs-5"><?= esc($pageTitle) ?></div>
                        <div class="breadcrumb-note">Kelola sistem pembelajaran online dengan antarmuka yang lebih modern dan rapi.</div>
                    </div>
                    <div class="topbar-mini">
                        <div class="status-dot"></div>
                        <span>Sistem aktif</span>
                        <span>•</span>
                        <span class="text-capitalize">Role: <?= esc($role) ?></span>
                    </div>
                </div>

                <?= $this->include('partials/flash') ?>
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
<?php else : ?>
    <?= $this->include('partials/flash') ?>
    <?= $this->renderSection('content') ?>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>?v=parallax-fix-2"></script>
</body>
</html>
