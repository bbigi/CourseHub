# Laporan Proyek - Sistem Manajemen Kursus Online

## BAB 1 Pendahuluan

### 1.1 Latar Belakang
Perkembangan pembelajaran digital membuat proses kursus tidak lagi terbatas pada ruang kelas. Lembaga kursus memerlukan sistem yang mampu mengelola data kursus, materi, instruktur, siswa, dan pendaftaran secara terpusat. Tanpa sistem yang terstruktur, proses pencatatan kursus, pemantauan progress belajar, dan pengelolaan materi dapat menjadi kurang efisien.

Berdasarkan kebutuhan tersebut, dikembangkan aplikasi Sistem Manajemen Kursus Online berbasis CodeIgniter 4. Aplikasi ini menerapkan konsep MVC, CRUD, REST API, autentikasi, otorisasi, serta mitigasi keamanan aplikasi web.

### 1.2 Tujuan
1. Mengembangkan aplikasi web dinamis berbasis CodeIgniter 4.
2. Menerapkan konsep MVC melalui pemisahan Model, View, Controller, Routing, dan Template Layout.
3. Menyediakan fitur CRUD untuk data kursus, materi, user, dan enrolmen.
4. Menyediakan REST API dengan method GET, POST, PUT, dan DELETE.
5. Menerapkan autentikasi, otorisasi, dan keamanan dasar aplikasi web.

## BAB 2 Analisis Perancangan

### 2.1 Analisis Kebutuhan Sistem

#### Kebutuhan Fungsional
1. Pengguna dapat melakukan login dan logout.
2. Siswa dapat melakukan registrasi akun.
3. Admin dapat mengelola data user.
4. Admin dan instruktur dapat mengelola data kursus.
5. Admin dan instruktur dapat mengelola materi kursus.
6. Siswa dapat melihat kursus yang tersedia.
7. Siswa dapat mendaftar kursus.
8. Siswa dapat memperbarui progress belajar.
9. Sistem menyediakan REST API untuk data kursus dan enrolmen.

#### Kebutuhan Nonfungsional
1. Sistem menggunakan validasi input.
2. Password disimpan menggunakan hashing.
3. Form web dilindungi CSRF token.
4. Output data ditampilkan menggunakan escaping.
5. REST API dilindungi menggunakan API key.
6. UI dibuat responsif menggunakan Bootstrap 5.

### 2.2 Use Case
Aktor sistem terdiri dari Admin, Instruktur, dan Siswa.

Admin dapat login, mengelola user, mengelola kursus, mengelola materi, dan melihat enrolmen. Instruktur dapat login, mengelola kursus miliknya, mengelola materi, dan memantau enrolmen. Siswa dapat registrasi, login, melihat kursus, mendaftar kursus, melihat materi, dan memperbarui progress belajar.

### 2.3 Struktur MVC
- Model: UserModel, CourseModel, LessonModel, EnrollmentModel.
- View: auth, dashboard, courses, lessons, enrollments, users, layouts.
- Controller: Auth, Dashboard, CourseController, LessonController, EnrollmentController, UserController, Api/Courses, Api/Enrollments.
- Routing: diatur pada `app/Config/Routes.php`.
- Template Layout: menggunakan `app/Views/layouts/main.php`.

## BAB 3 Pembagian Tugas Tim

| Nama Anggota | Tugas |
|---|---|
| Anggota 1 | Analisis kebutuhan, desain database, laporan BAB 1-2 |
| Anggota 2 | Implementasi MVC, CRUD kursus dan materi |
| Anggota 3 | Implementasi autentikasi, REST API, keamanan, dokumentasi pengujian |

## BAB 4 Implementasi

### 4.1 Screenshot Sistem
Screenshot yang perlu dimasukkan ke laporan:
1. Halaman login.
2. Halaman register siswa.
3. Dashboard.
4. Halaman data kursus.
5. Form tambah/edit kursus.
6. Detail kursus.
7. Halaman materi kursus.
8. Halaman enrolmen/progress siswa.
9. Halaman manajemen user.
10. Pengujian REST API di Postman/Thunder Client.

### 4.2 Implementasi MVC
Aplikasi menerapkan MVC dengan pemisahan tanggung jawab. Controller mengatur alur request, Model berhubungan dengan database, sedangkan View menampilkan antarmuka pengguna. Routing digunakan untuk mengarahkan URL ke controller yang sesuai.

### 4.3 Implementasi CRUD
CRUD diterapkan pada data kursus, materi, user, dan enrolmen. Operasi tambah, tampil, ubah, dan hapus dilakukan melalui controller dan model masing-masing.

### 4.4 Implementasi REST API
REST API disediakan pada endpoint `/api/courses` dan `/api/enrollments`. API mendukung method GET, POST, PUT, dan DELETE. Pengujian dilakukan menggunakan Postman atau Thunder Client dengan header `X-API-KEY`.

### 4.5 Mitigasi Keamanan
1. Password disimpan menggunakan `password_hash()` dan diverifikasi menggunakan `password_verify()`.
2. Login melakukan `session()->regenerate(true)` untuk mengurangi risiko session fixation.
3. Form web menggunakan CSRF token.
4. Output pada view menggunakan `esc()` untuk mengurangi risiko XSS.
5. Input divalidasi melalui rules pada controller dan model.
6. REST API menggunakan header `X-API-KEY`.
7. Akses halaman dibatasi dengan AuthFilter dan RoleFilter.
8. SecureHeaders diaktifkan pada filter global.

## BAB 5 Penutup

### 5.1 Kesimpulan
Aplikasi Sistem Manajemen Kursus Online berhasil dikembangkan menggunakan CodeIgniter 4 dengan penerapan MVC, CRUD, REST API, autentikasi, otorisasi, front-end framework, dan mitigasi keamanan dasar. Sistem ini dapat digunakan untuk mengelola kursus, materi, user, enrolmen, dan progress belajar siswa.

### 5.2 Saran
Pengembangan berikutnya dapat menambahkan fitur upload materi, pembayaran kursus, sertifikat otomatis, diskusi kelas, dan notifikasi email.
