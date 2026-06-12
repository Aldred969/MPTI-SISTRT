# SISTRT - Sistem Informasi Rukun Tetangga

**SISTRT** (Sistem Informasi Rukun Tetangga) adalah sebuah platform aplikasi web yang dirancang untuk mempermudah tata kelola administrasi, keuangan (iuran), pelaporan/pengaduan warga, serta publikasi agenda kegiatan di tingkat Rukun Tetangga (RT). 

Aplikasi ini mengadopsi otorisasi berbasis peran (*role-based access control*) untuk membedakan hak akses antara pengurus RT (**Admin**) dan warga setempat (**Warga**).

---

## 🚀 Fitur Utama

Aplikasi ini terbagi menjadi dua bagian halaman utama berdasarkan hak akses pengguna:

### 👨‍💼 Fitur Admin (Pengurus RT)
1. **Dashboard Ringkasan**: Menampilkan metrik data warga, total iuran masuk, dan jumlah laporan dari warga.
2. **Manajemen Warga (CRUD)**:
   - Menambah, mengubah, mencari, dan menghapus data warga.
   - Pendaftaran menggunakan **NIK (Nomor Induk Kependudukan)** unik sepanjang 16 digit.
3. **Manajemen Iuran (Keuangan RT)**:
   - Menghasilkan daftar iuran bulanan untuk setiap warga.
   - Mengubah status pembayaran warga (Belum Bayar / Lunas).
   - Melihat histori iuran warga tertentu secara detail.
   - Rekapitulasi laporan keuangan dan perhitungan total kas masuk.
4. **Tanggapan Laporan / Pengaduan**:
   - Melihat daftar laporan/keluhan yang dikirimkan warga.
   - Memberikan tanggapan dan mengubah status tindak lanjut (Pending, Proses, Selesai).
5. **Agenda Kegiatan (CRUD)**:
   - Membuat jadwal kegiatan sosial RT (seperti Kerja Bakti, Rapat Bulanan, dll).
   - Menampilkan agenda untuk dapat dilihat oleh seluruh warga.

### 👥 Fitur Warga
1. **Histori Pembayaran Iuran**:
   - Memantau status pembayaran iuran bulanan pribadi (lunas/belum lunas).
   - Melihat tanggal bayar dan nominal secara transparan.
2. **Pengaduan & Laporan Mandiri**:
   - Membuat laporan pengaduan baru terkait masalah lingkungan, keamanan, kebersihan, dll.
   - Memantau status respon dari Admin terhadap laporan yang dikirimkan.
3. **Informasi Kegiatan**:
   - Melihat pengumuman dan agenda kegiatan RT yang akan datang.

---

## 🛠️ Spesifikasi Teknologi

Aplikasi ini dibangun menggunakan tumpukan teknologi modern berikut:

- **Backend Framework**: [Laravel v11/v13](https://laravel.com) (PHP ^8.3)
- **Frontend Assets & Bundler**: [Vite](https://vite.dev) & [Tailwind CSS](https://tailwindcss.com)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) (Dimodifikasi menggunakan NIK & Email)
- **Database**: SQLite (default untuk kemudahan setup) atau MySQL/PostgreSQL

---

## ⚙️ Persyaratan Sistem

Pastikan perangkat Anda telah terpasang:
- PHP >= 8.3
- Composer
- Node.js & NPM
- Database engine (SQLite, MySQL, atau PostgreSQL)

---

## 💻 Instalasi dan Konfigurasi

Ikuti langkah-langkah di bawah untuk memasang proyek ini di komputer lokal Anda:

### 1. Klon Repositori
```bash
git clone https://github.com/Aldred969/MPTI-SISTRT.git
cd MPTI-SISTRT
```

### 2. Konfigurasi Environment File
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Secara default, aplikasi menggunakan database **SQLite**. Jika Anda menggunakan SQLite, buat file database kosong di direktori database:
```bash
# Untuk Linux / macOS / Git Bash
touch database/database.sqlite

# Untuk PowerShell (Windows)
New-Item -Path database\database.sqlite -ItemType File
```

*Catatan: Jika ingin menggunakan MySQL, ubah variabel `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di dalam file `.env` sesuai dengan server database lokal Anda.*

### 3. Cara Cepat: Setup Otomatis
Proyek ini dilengkapi dengan skrip Composer kustom untuk mempermudah pemasangan semua dependensi, migrasi database, dan build aset sekaligus:
```bash
composer run setup
```
Skrip di atas akan secara otomatis menjalankan:
- `composer install`
- Pembuatan file `.env` (bila belum ada)
- `php artisan key:generate`
- `php artisan migrate --force`
- `npm install`
- `npm run build`

### 4. Seed Database (Data Uji Coba)
Jalankan seeder untuk mengisi data awal warga, admin, iuran, pengumuman, dan agenda kegiatan simulasi:
```bash
php artisan db:seed
```

---

## 🔑 Akun Uji Coba (Credentials)

Setelah melakukan seeding, Anda dapat masuk ke dalam sistem menggunakan akun simulasi berikut:

| Peran (Role) | Email | NIK (Username alternatif) | Kata Sandi (Password) |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `1234567890123456` | `rahasia123` |
| **Warga** | `warga@example.com` | `1234567890123457` | `rahasia123` |

---

## 🏃‍♂️ Cara Menjalankan Aplikasi

Aplikasi ini memanfaatkan `concurrently` untuk menjalankan web server Laravel dan pemantau aset Vite secara bersamaan dalam satu baris perintah.

Untuk menjalankan mode pengembangan (*Development Mode*):
```bash
composer run dev
```

Perintah di atas akan menjalankan:
- **Server**: `php artisan serve` (Web server lokal)
- **Queue Listener**: `php artisan queue:listen` (Pemroses antrian background)
- **Tail Logger**: `php artisan pail` (Pail logger untuk logs *real-time*)
- **Vite Server**: `npm run dev` (Compiler CSS/JS asset)

Setelah aktif, Anda dapat membuka aplikasi melalui peramban web pada alamat:
👉 **[http://localhost:8000](http://localhost:8000)**
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
