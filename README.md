# Studify – Platform Kursus Daring

Studify adalah aplikasi platform kursus daring yang dirancang untuk menyediakan layanan pembelajaran digital yang interaktif antara Admin, Teacher, Student, dan Public User (Guest). Sistem ini menyediakan modul lengkap untuk pengelolaan pengguna, course, konten pembelajaran, kategori, serta progress belajar. Antarmuka mencakup homepage, katalog course, halaman detail course, dashboard khusus per role, serta halaman materi (lesson) yang mendukung fitur “mark as done”.

Aplikasi ini dibangun mengikuti standar Content Management System (CMS) dengan struktur yang mudah dikembangkan, aman, dan ramah pengguna.

---

## Rincian Alur Aplikasi

#### 1. Login / Registrasi

-   Admin login menggunakan akun yang telah disediakan melalui seeder.

-   Teacher dan Student dapat melakukan registrasi melalui halaman register.

-   Public User (Guest) dapat mengakses katalog course tanpa login.

#### 2. Akses Dashboard Berdasarkan Role

-   Admin: Mengelola pengguna, kategori, course, dan seluruh aktivitas platform.

-   Teacher: Membuat dan mengelola course serta kontennya, dan memantau progress student.

-   Student: Mengikuti course, mengakses materi, melakukan penandaan selesai pada pelajaran, serta memantau progress belajar.

-   Guest: Hanya dapat melihat katalog, course populer, dan detail course tanpa akses materi.

#### 3. Manajemen Pengguna (Admin)

-   Menampilkan seluruh pengguna menggunakan pagination.

-   Tambah pengguna baru (student atau teacher).

-   Edit pengguna (username, email, password, role, status aktif/nonaktif).

-   Hapus pengguna yang tidak diperlukan.

-   Manajemen Course (Admin & Teacher)

-   Tambah, edit, dan hapus course sesuai peran.

-   Teacher hanya dapat mengelola course yang dia buat sendiri.

-   Admin memiliki akses penuh untuk mengelola semua course.

-   Course memiliki data: nama, deskripsi, rentang waktu, kategori, dan teacher pengajar.

#### 4. Manajemen Konten Pembelajaran (Teacher)

-   Tambah materi baru dalam bentuk teks atau media.

-   Edit judul dan isi materi.

-   Hapus materi yang dibuat oleh teacher sendiri.

-   Semua materi ditampilkan berurutan dalam lesson page.

#### 5. Manajemen Kategori (Admin)

-   Tambah, edit, hapus, dan menampilkan daftar kategori course.

-   Kategori digunakan untuk memfilter dan mengelompokkan course.

---

Langkah-Langkah Penggunaan

#### 1. Clone Repositori:

```
git clone https://github.com/diestymendila/studify.git
```

#### 2. Masuk ke Direktori Proyek:

```
cd Studify
```

#### 3. Instal Dependensi Laravel:

```
composer install
```

#### 4. Salin atau Buat File .env:

Jika hanya terdapat .env.example, ubah menjadi .env, lalu sesuaikan konfigurasi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=platform_kursus
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Buka XAMPP lalu jalankan MySQL.

-   Migrasi Database dan Jalankan Seeder:

-   php artisan migrate --seed

#### 6. Jalankan Server Aplikasi:

```
php artisan serve
```

#### 7. Instal Dependensi NPM:

```
npm install
```

#### 8. Jalankan Vite:

```
npm run dev
```

```
Generate App Key:
```

```
php artisan key:generate
```

#### 9. Akses aplikasi melalui:

```
http://127.0.0.1:8000/
```
