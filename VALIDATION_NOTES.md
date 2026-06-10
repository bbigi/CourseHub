# Validation Notes

Pemeriksaan yang sudah dilakukan di environment ChatGPT:

- Semua file PHP pada folder `app/` lolos syntax check dengan `php -l`.
- Runtime command `php spark routes` belum dapat dijalankan di environment ini karena extension PHP `intl` dan `mbstring` tidak aktif.

Agar berjalan di laptop lokal, aktifkan extension berikut pada `php.ini`:

```ini
extension=intl
extension=mbstring
extension=mysqli
```

Setelah extension aktif, jalankan:

```bash
php spark migrate
php spark db:seed CourseAppSeeder
php spark serve
```
