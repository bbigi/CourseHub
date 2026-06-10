# CourseHub - Sistem Manajemen Kursus Online Berbasis CodeIgniter 4

CourseHub adalah aplikasi web dinamis untuk mengelola kursus online. Sistem ini dikembangkan menggunakan Framework CodeIgniter 4 dengan konsep MVC, CRUD, REST API, autentikasi, otorisasi role, keamanan aplikasi, dan tampilan antarmuka modern berbasis Bootstrap serta custom UI. Proyek ini dibuat untuk memenuhi final project mata kuliah Pemrograman Web Lanjut Semester 5 Genap 2025/2026.

## Identitas Project

| Keterangan    | Isi                                                  |
| ------------- | ---------------------------------------------------- |
| Nama Aplikasi | CourseHub                                            |
| Tema          | Sistem Manajemen Kursus Online                       |
| Framework     | CodeIgniter 4                                        |
| Arsitektur    | MVC                                                  |
| Front-End     | Bootstrap 5, Bootstrap Icons, Custom CSS, JavaScript |
| Database      | MySQL                                                |
| API           | RESTful API                                          |
| Autentikasi   | Login, Register, Logout                              |
| Otorisasi     | Role Admin, Instruktur, Siswa                        |
| Pengujian API | Postman / Thunder Client                             |
| Repository    | Diunggah ke GitHub salah satu anggota kelompok       |

## Deskripsi Singkat Sistem

CourseHub adalah sistem manajemen kursus online yang digunakan untuk mengelola data kursus, materi pembelajaran, user, enrolmen, dan progress belajar siswa. Sistem ini memiliki tiga jenis pengguna, yaitu admin, instruktur, dan siswa.

Admin dapat mengelola seluruh data sistem, termasuk data user, kursus, materi, dan enrolmen. Instruktur dapat mengelola kursus serta materi pembelajaran yang dibuat. Siswa dapat melihat daftar kursus, mendaftar kursus, melihat materi, dan memperbarui progress belajar.

## Jawaban Spesifikasi Minimum Project

### 1. Implementasi MVC

Sistem CourseHub menerapkan konsep MVC yang terdiri dari Model, View, Controller, Routing, dan Template Layout.

#### Model

Model digunakan untuk mengelola komunikasi antara aplikasi dengan database.

Model yang digunakan:

| Model           | Fungsi                                                      |
| --------------- | ----------------------------------------------------------- |
| UserModel       | Mengelola data user, role, email, password, dan status akun |
| CourseModel     | Mengelola data kursus                                       |
| LessonModel     | Mengelola data materi kursus                                |
| EnrollmentModel | Mengelola data pendaftaran kursus dan progress siswa        |

#### View

View digunakan untuk menampilkan halaman sistem kepada pengguna.

View yang digunakan:

| Folder View | Fungsi                                            |
| ----------- | ------------------------------------------------- |
| landing     | Menampilkan landing page CourseHub                |
| auth        | Menampilkan halaman login dan register            |
| dashboard   | Menampilkan dashboard utama                       |
| courses     | Menampilkan halaman CRUD kursus                   |
| lessons     | Menampilkan halaman CRUD materi                   |
| enrollments | Menampilkan data enrolmen dan progress            |
| users       | Menampilkan halaman manajemen user                |
| layouts     | Menyimpan template layout utama                   |
| partials    | Menyimpan komponen tambahan seperti flash message |

#### Controller

Controller digunakan untuk mengatur alur request dari user, mengambil data melalui model, dan mengirimkannya ke view.

Controller yang digunakan:

| Controller           | Fungsi                                                           |
| -------------------- | ---------------------------------------------------------------- |
| Home                 | Menampilkan landing page dan mengarahkan user login ke dashboard |
| Auth                 | Mengatur login, register, dan logout                             |
| Dashboard            | Menampilkan ringkasan data sistem                                |
| CourseController     | Mengatur CRUD kursus                                             |
| LessonController     | Mengatur CRUD materi kursus                                      |
| EnrollmentController | Mengatur enrolmen dan progress belajar                           |
| UserController       | Mengatur manajemen user                                          |
| Api/Courses          | Mengatur REST API kursus                                         |
| Api/Enrollments      | Mengatur REST API enrolmen                                       |

#### Routing

Routing digunakan untuk mengatur URL aplikasi.

Contoh route web:

| Method | Route              | Fungsi             |
| ------ | ------------------ | ------------------ |
| GET    | /                  | Landing page       |
| GET    | /login             | Halaman login      |
| POST   | /login             | Proses login       |
| GET    | /register          | Halaman register   |
| POST   | /register          | Proses register    |
| GET    | /dashboard         | Dashboard          |
| GET    | /courses           | Daftar kursus      |
| GET    | /courses/new       | Form tambah kursus |
| POST   | /courses           | Simpan kursus      |
| GET    | /courses/{id}      | Detail kursus      |
| GET    | /courses/{id}/edit | Form edit kursus   |
| PUT    | /courses/{id}      | Update kursus      |
| DELETE | /courses/{id}      | Hapus kursus       |
| GET    | /enrollments       | Data enrolmen      |
| GET    | /users             | Data user          |

#### Template Layout

Template layout digunakan pada file:

```text
app/Views/layouts/main.php
```

Layout ini berisi struktur utama halaman seperti pemanggilan Bootstrap, CSS, JavaScript, sidebar, topbar, navigasi, dan area konten utama.

### 2. Implementasi Database dan CRUD

Sistem menggunakan database MySQL dengan beberapa tabel utama.

#### Struktur Tabel

| Tabel       | Fungsi                                               |
| ----------- | ---------------------------------------------------- |
| users       | Menyimpan data pengguna                              |
| courses     | Menyimpan data kursus                                |
| lessons     | Menyimpan data materi kursus                         |
| enrollments | Menyimpan data pendaftaran kursus dan progress siswa |

#### CRUD yang Diimplementasikan

| Modul    | Create | Read | Update | Delete          |
| -------- | ------ | ---- | ------ | --------------- |
| User     | Ada    | Ada  | Ada    | Ada             |
| Kursus   | Ada    | Ada  | Ada    | Ada             |
| Materi   | Ada    | Ada  | Ada    | Ada             |
| Enrolmen | Ada    | Ada  | Ada    | Ada melalui API |
| Progress | Ada    | Ada  | Ada    | -               |

#### Fitur CRUD Kursus

Admin dan instruktur dapat melakukan:

1. Menambah kursus baru.
2. Melihat daftar kursus.
3. Melihat detail kursus.
4. Mengubah data kursus.
5. Menghapus kursus.
6. Mengelola materi pada kursus.

#### Fitur CRUD Materi

Admin dan instruktur dapat melakukan:

1. Menambah materi.
2. Melihat daftar materi.
3. Mengubah materi.
4. Menghapus materi.

#### Fitur CRUD User

Admin dapat melakukan:

1. Menambah user.
2. Melihat data user.
3. Mengubah data user.
4. Menghapus user.

#### Fitur Enrolmen

Siswa dapat:

1. Melihat daftar kursus.
2. Mendaftar kursus.
3. Melihat kursus yang diikuti.
4. Mengubah progress belajar.

Admin dan instruktur dapat:

1. Melihat data enrolmen.
2. Memantau progress belajar siswa.

### 3. Implementasi Front-End Framework

Sistem CourseHub menggunakan Bootstrap 5 sebagai front-end framework utama. Bootstrap digunakan untuk membuat tampilan responsif, form, tombol, tabel, card, badge, grid, dan komponen layout.

Selain Bootstrap, sistem juga menggunakan:

1. Bootstrap Icons untuk ikon visual.
2. Custom CSS untuk memperbaiki tampilan UI/UX.
3. JavaScript untuk efek interaktif pada landing page.
4. Layout modern dengan sidebar, topbar, card, table, dan form yang lebih rapi.

#### Tampilan yang Dibuat

| Halaman       | Keterangan                                                           |
| ------------- | -------------------------------------------------------------------- |
| Landing Page  | Halaman awal CourseHub dengan tampilan modern dan efek visual scroll |
| Login         | Halaman masuk pengguna                                               |
| Register      | Halaman pendaftaran siswa                                            |
| Dashboard     | Ringkasan data sistem                                                |
| Data Kursus   | Halaman daftar dan pengelolaan kursus                                |
| Detail Kursus | Informasi lengkap kursus dan daftar materi                           |
| Materi        | Halaman pengelolaan materi pembelajaran                              |
| Enrolmen      | Halaman data pendaftaran dan progress siswa                          |
| User          | Halaman manajemen user untuk admin                                   |

### 4. Penerapan RESTful API

Sistem CourseHub menyediakan RESTful API untuk mendukung integrasi data. API dapat diuji menggunakan Postman atau Thunder Client.

API menggunakan header:

```text
X-API-KEY: coursehub-secret-key
```

#### API Kursus

| Method | Endpoint          | Fungsi                          |
| ------ | ----------------- | ------------------------------- |
| GET    | /api/courses      | Menampilkan seluruh data kursus |
| GET    | /api/courses/{id} | Menampilkan detail kursus       |
| POST   | /api/courses      | Menambah data kursus            |
| PUT    | /api/courses/{id} | Mengubah data kursus            |
| DELETE | /api/courses/{id} | Menghapus data kursus           |

#### API Enrolmen

| Method | Endpoint              | Fungsi                            |
| ------ | --------------------- | --------------------------------- |
| GET    | /api/enrollments      | Menampilkan seluruh data enrolmen |
| GET    | /api/enrollments/{id} | Menampilkan detail enrolmen       |
| POST   | /api/enrollments      | Menambah data enrolmen            |
| PUT    | /api/enrollments/{id} | Mengubah data enrolmen            |
| DELETE | /api/enrollments/{id} | Menghapus data enrolmen           |

#### Contoh Request API Tambah Kursus

Endpoint:

```text
POST /api/courses
```

Header:

```text
Content-Type: application/json
X-API-KEY: coursehub-secret-key
```

Body JSON:

```json
{
  "title": "Belajar PHP Dasar",
  "category": "Programming",
  "description": "Kursus dasar pemrograman PHP untuk pemula.",
  "level": "pemula",
  "price": 100000,
  "status": "published",
  "instructor_id": 2,
  "thumbnail": "https://images.unsplash.com/photo-1498050108023-c5249f4df085"
}
```

#### Contoh Request API Update Kursus

Endpoint:

```text
PUT /api/courses/1
```

Header:

```text
Content-Type: application/json
X-API-KEY: coursehub-secret-key
```

Body JSON:

```json
{
  "title": "Belajar PHP Dasar Revisi",
  "category": "Programming",
  "description": "Kursus PHP dasar yang sudah diperbarui.",
  "level": "pemula",
  "price": 120000,
  "status": "published",
  "instructor_id": 2
}
```

#### Contoh Request API Delete Kursus

Endpoint:

```text
DELETE /api/courses/1
```

Header:

```text
X-API-KEY: coursehub-secret-key
```

### 5. Keamanan Aplikasi

Sistem CourseHub menerapkan beberapa mitigasi keamanan aplikasi web.

#### Autentikasi

Sistem memiliki fitur login dan register. User harus login terlebih dahulu untuk mengakses halaman dashboard dan fitur utama sistem.

#### Otorisasi Role

Sistem memiliki tiga role:

| Role       | Hak Akses                                             |
| ---------- | ----------------------------------------------------- |
| Admin      | Mengelola seluruh data sistem                         |
| Instruktur | Mengelola kursus dan materi                           |
| Siswa      | Melihat kursus, mendaftar kursus, dan update progress |

Manajemen user hanya dapat diakses oleh admin.

#### Password Hashing

Password user disimpan menggunakan hashing dengan fungsi:

```php
password_hash()
```

Validasi login menggunakan:

```php
password_verify()
```

Dengan cara ini, password tidak disimpan dalam bentuk teks asli.

#### CSRF Protection

Form web menggunakan CSRF token untuk mencegah serangan Cross Site Request Forgery.

Contoh implementasi:

```php
<?= csrf_field() ?>
```

#### Validasi Input

Input dari user divalidasi sebelum disimpan ke database. Validasi diterapkan pada data kursus, materi, user, login, register, dan API.

#### Escaping Output

Data yang ditampilkan pada view menggunakan:

```php
esc()
```

Tujuannya untuk mengurangi risiko Cross Site Scripting atau XSS.

#### API Key

REST API dilindungi menggunakan API key melalui header:

```text
X-API-KEY
```

Request API tanpa API key yang valid akan ditolak.

#### Filter Auth dan Role

Sistem menggunakan filter untuk membatasi akses halaman.

Filter yang digunakan:

| Filter       | Fungsi                                  |
| ------------ | --------------------------------------- |
| AuthFilter   | Memastikan user sudah login             |
| RoleFilter   | Membatasi halaman berdasarkan role      |
| ApiKeyFilter | Membatasi akses API menggunakan API key |

### 6. Hasil Akhir Aplikasi

Hasil akhir dari project CourseHub adalah aplikasi web manajemen kursus online berbasis CodeIgniter 4 yang sudah memiliki fitur lengkap sesuai ketentuan final project.

#### Hasil Akhir yang Tersedia

| Hasil Akhir                             | Status  |
| --------------------------------------- | ------- |
| Aplikasi web berbasis CodeIgniter 4     | Selesai |
| Source code aplikasi                    | Selesai |
| Implementasi MVC                        | Selesai |
| Implementasi CRUD                       | Selesai |
| Implementasi database MySQL             | Selesai |
| Implementasi front-end framework        | Selesai |
| Implementasi REST API                   | Selesai |
| Autentikasi login/register/logout       | Selesai |
| Otorisasi role admin, instruktur, siswa | Selesai |
| Mitigasi keamanan aplikasi              | Selesai |
| Seeder data awal                        | Selesai |
| Migration database                      | Selesai |
| Postman collection                      | Selesai |
| Laporan proyek ringkas                  | Selesai |
| README dokumentasi                      | Selesai |
| Siap upload GitHub                      | Selesai |

### 7. Fitur Sistem

#### Fitur Admin

1. Login ke sistem.
2. Melihat dashboard.
3. Mengelola data kursus.
4. Mengelola materi kursus.
5. Mengelola data enrolmen.
6. Mengelola data user.
7. Melihat progress belajar siswa.
8. Logout dari sistem.

#### Fitur Instruktur

1. Login ke sistem.
2. Melihat dashboard.
3. Mengelola kursus.
4. Mengelola materi kursus.
5. Melihat data enrolmen.
6. Memantau progress siswa.
7. Logout dari sistem.

#### Fitur Siswa

1. Register akun.
2. Login ke sistem.
3. Melihat daftar kursus.
4. Melihat detail kursus.
5. Mendaftar kursus.
6. Melihat materi.
7. Mengubah progress belajar.
8. Logout dari sistem.

### 8. Struktur Folder Utama

```text
CourseHub-CI4/
├── app/
│   ├── Config/
│   │   ├── Routes.php
│   │   └── Filters.php
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── Courses.php
│   │   │   └── Enrollments.php
│   │   ├── Auth.php
│   │   ├── CourseController.php
│   │   ├── Dashboard.php
│   │   ├── EnrollmentController.php
│   │   ├── Home.php
│   │   ├── LessonController.php
│   │   └── UserController.php
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Filters/
│   │   ├── ApiKeyFilter.php
│   │   ├── AuthFilter.php
│   │   └── RoleFilter.php
│   ├── Models/
│   │   ├── CourseModel.php
│   │   ├── EnrollmentModel.php
│   │   ├── LessonModel.php
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/
│       ├── courses/
│       ├── dashboard/
│       ├── enrollments/
│       ├── landing/
│       ├── layouts/
│       ├── lessons/
│       ├── partials/
│       └── users/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   └── index.php
├── database.sql
├── CourseHub_API_Postman_Collection.json
├── LAPORAN_PROYEK_RINGKAS.md
└── README.md
```

### 9. Cara Instalasi

#### 1. Clone Repository

```bash
git clone https://github.com/username/coursehub-ci4.git
cd coursehub-ci4
```

#### 2. Install Dependency

```bash
composer install
```

#### 3. Buat File Environment

Salin file environment:

```bash
cp env .env
```

Atur konfigurasi database pada file `.env`:

```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = coursehub_ci4
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

#### 4. Buat Database

Buat database baru di MySQL:

```sql
CREATE DATABASE coursehub_ci4;
```

#### 5. Jalankan Migration

```bash
php spark migrate
```

#### 6. Jalankan Seeder

```bash
php spark db:seed CourseAppSeeder
```

#### 7. Jalankan Server

```bash
php spark serve
```

Akses aplikasi melalui browser:

```text
http://localhost:8080
```

### 10. Akun Demo

| Role       | Email                                                   | Password    |
| ---------- | ------------------------------------------------------- | ----------- |
| Admin      | [admin@course.test](mailto:admin@course.test)           | password123 |
| Instruktur | [instruktur@course.test](mailto:instruktur@course.test) | password123 |
| Siswa      | [siswa@course.test](mailto:siswa@course.test)           | password123 |

### 11. Cara Pengujian Web

#### Pengujian Login

1. Buka halaman login.
2. Masukkan email dan password.
3. Jika data benar, sistem masuk ke dashboard.
4. Jika data salah, sistem menampilkan pesan error.

#### Pengujian CRUD Kursus

1. Login sebagai admin atau instruktur.
2. Buka menu Kursus.
3. Tambah kursus baru.
4. Lihat data kursus pada tabel.
5. Edit data kursus.
6. Hapus data kursus.

#### Pengujian Materi

1. Login sebagai admin atau instruktur.
2. Buka menu Kursus.
3. Klik tombol Materi.
4. Tambahkan materi baru.
5. Edit materi.
6. Hapus materi.

#### Pengujian Enrolmen

1. Login sebagai siswa.
2. Buka menu Kursus.
3. Pilih salah satu kursus.
4. Klik Daftar Kursus.
5. Buka menu Enrolmen.
6. Update progress belajar.

#### Pengujian Manajemen User

1. Login sebagai admin.
2. Buka menu User.
3. Tambah user baru.
4. Edit user.
5. Hapus user.

### 12. Cara Pengujian REST API

Pengujian REST API dilakukan menggunakan Postman atau Thunder Client.

Header wajib:

```text
X-API-KEY: coursehub-secret-key
Content-Type: application/json
```

#### GET Data Kursus

```text
GET http://localhost:8080/api/courses
```

Hasil:

```json
{
  "status": 200,
  "data": [
    {
      "id": 1,
      "title": "Dasar Pemrograman Web",
      "category": "Web Development",
      "level": "pemula",
      "status": "published"
    }
  ]
}
```

#### POST Data Kursus

```text
POST http://localhost:8080/api/courses
```

Body:

```json
{
  "title": "Belajar JavaScript Dasar",
  "category": "Web Development",
  "description": "Kursus dasar JavaScript untuk pemula.",
  "level": "pemula",
  "price": 150000,
  "status": "published",
  "instructor_id": 2
}
```

#### PUT Data Kursus

```text
PUT http://localhost:8080/api/courses/1
```

Body:

```json
{
  "title": "Belajar JavaScript Dasar Revisi",
  "category": "Web Development",
  "description": "Kursus JavaScript dasar yang sudah diperbarui.",
  "level": "pemula",
  "price": 175000,
  "status": "published",
  "instructor_id": 2
}
```

#### DELETE Data Kursus

```text
DELETE http://localhost:8080/api/courses/1
```

### 13. Hasil Implementasi Tampilan

#### Landing Page

Landing page berisi informasi utama CourseHub sebagai sistem manajemen kursus online. Pada halaman ini terdapat hero section, fitur sistem, preview kursus, alur penggunaan, dan tombol call to action untuk login atau daftar.

#### Login dan Register

Halaman login digunakan untuk masuk ke sistem. Halaman register digunakan siswa untuk membuat akun baru.

#### Dashboard

Dashboard menampilkan ringkasan jumlah kursus, materi, enrolmen, user, akses cepat, dan daftar kursus terbaru.

#### Kursus

Halaman kursus menampilkan daftar kursus. Admin dan instruktur dapat menambah, mengubah, dan menghapus kursus.

#### Detail Kursus

Halaman detail kursus menampilkan deskripsi kursus, kategori, level, harga, instruktur, dan daftar materi.

#### Materi

Halaman materi digunakan untuk mengelola isi materi pembelajaran pada setiap kursus.

#### Enrolmen

Halaman enrolmen menampilkan data pendaftaran kursus dan progress belajar siswa.

#### User

Halaman user hanya dapat diakses admin untuk mengelola akun pengguna.

### 14. Pembagian Role dan Hak Akses

| Fitur           | Admin | Instruktur | Siswa                               |
| --------------- | ----- | ---------- | ----------------------------------- |
| Login           | Ya    | Ya         | Ya                                  |
| Register        | Tidak | Tidak      | Ya                                  |
| Dashboard       | Ya    | Ya         | Ya                                  |
| Kelola Kursus   | Ya    | Ya         | Tidak                               |
| Lihat Kursus    | Ya    | Ya         | Ya                                  |
| Kelola Materi   | Ya    | Ya         | Tidak                               |
| Lihat Materi    | Ya    | Ya         | Ya                                  |
| Daftar Kursus   | Tidak | Tidak      | Ya                                  |
| Update Progress | Tidak | Tidak      | Ya                                  |
| Kelola User     | Ya    | Tidak      | Tidak                               |
| REST API        | Ya    | Ya         | Terbatas sesuai kebutuhan pengujian |

### 15. Kesimpulan

CourseHub berhasil dikembangkan sebagai aplikasi web modern berbasis CodeIgniter 4 untuk sistem manajemen kursus online. Sistem ini sudah menerapkan konsep MVC, CRUD, database, front-end framework, RESTful API, autentikasi, otorisasi, dan keamanan aplikasi web. Dengan adanya fitur pengelolaan kursus, materi, user, enrolmen, dan progress belajar, aplikasi ini telah memenuhi spesifikasi minimum final project Pemrograman Web Lanjut.

### 16. Saran Pengembangan

Beberapa pengembangan yang dapat dilakukan pada tahap berikutnya adalah:

1. Menambahkan fitur upload file materi.
2. Menambahkan fitur kuis atau ujian online.
3. Menambahkan fitur sertifikat setelah kursus selesai.
4. Menambahkan fitur pembayaran kursus.
5. Menambahkan notifikasi untuk siswa dan instruktur.
6. Menambahkan dashboard statistik yang lebih detail.
7. Menambahkan fitur komentar atau diskusi pada setiap materi.
