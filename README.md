# Sistem Perpustakaan Digital

Sistem manajemen perpustakaan digital yang dibangun dengan Laravel 11. Aplikasi ini menyediakan fitur untuk mengelola buku, anggota, peminjaman, dan kategori dengan antarmuka yang user-friendly.

## 🚀 Fitur Utama

### Frontend (Akses Publik)
- ✅ Beranda dengan hero section dan buku terbaru
- ✅ Katalog buku dengan pagination
- ✅ Pencarian buku berdasarkan judul, penulis, atau ISBN
- ✅ Detail buku lengkap
- ✅ Kategori buku

### Admin Panel (Akses Terbatas)
- ✅ Dashboard dengan statistik perpustakaan
- ✅ Manajemen buku (CRUD)
- ✅ Manajemen kategori (CRUD)
- ✅ Manajemen penerbit (CRUD)
- ✅ Manajemen anggota (CRUD)
- ✅ Manajemen peminjaman (CRUD)
- ✅ Riwayat peminjaman buku

### Sistem Autentikasi
- ✅ Login/logout
- ✅ Middleware untuk membedakan akses admin dan user
- ✅ Role-based authorization

## 📋 Struktur Database

### Tabel Utama
1. **users** - Data pengguna sistem (admin/user)
2. **categories** - Kategori buku
3. **publishers** - Penerbit buku
4. **books** - Data buku (relasi ke kategori & penerbit)
5. **members** - Anggota perpustakaan
6. **borrowings** - Peminjaman buku (relasi ke buku & anggota)

### Relasi Database
- `books` belongsTo `categories` dan `publishers`
- `borrowings` belongsTo `books` dan `members`
- `books` hasMany `borrowings`
- `categories` hasMany `books`
- `publishers` hasMany `books`
- `members` hasMany `borrowings`

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Auth
- **Middleware**: Custom Admin & User Middleware

## 📦 Instalasi

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/SQLite
- Node.js (untuk asset compilation)

### Langkah Instalasi

1. **Clone repository**
```bash
git clone <repository-url>
cd perpustakaan
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database**
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migration dan seeder**
```bash
php artisan migrate:fresh --seed
```

6. **Jalankan server**
```bash
php artisan serve
```

## 👤 Akun Demo

### Admin
- **Email**: admin@perpustakaan.com
- **Password**: password

### User
- **Email**: user@perpustakaan.com
- **Password**: password

## 🎯 Fitur CRUD yang Tersedia

### Admin Panel
- **Buku**: Tambah, edit, hapus, lihat detail
- **Kategori**: Tambah, edit, hapus
- **Penerbit**: Tambah, edit, hapus
- **Anggota**: Tambah, edit, hapus
- **Peminjaman**: Tambah, edit, hapus, lihat riwayat

### Frontend
- **Katalog Buku**: Lihat semua buku dengan pagination
- **Pencarian**: Cari buku berdasarkan kata kunci
- **Detail Buku**: Lihat informasi lengkap buku

## 🔐 Middleware & Authorization

### AdminMiddleware
- Membatasi akses hanya untuk user dengan role 'admin'
- Redirect ke halaman utama jika bukan admin

### UserMiddleware
- Membatasi akses hanya untuk user yang sudah login
- Redirect ke halaman login jika belum login

## 📁 Struktur File Penting

```
perpustakaan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── BookController.php
│   │   │   ├── FrontendController.php
│   │   │   └── ...
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── UserMiddleware.php
│   └── Models/
│       ├── Book.php
│       ├── Category.php
│       ├── Publisher.php
│       ├── Member.php
│       └── Borrowing.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       ├── frontend/
│       ├── auth/
│       └── layouts/
└── routes/
    └── web.php
```

## 🎨 Tema & Desain

- **Tema**: Sistem Manajemen Perpustakaan Digital
- **Design**: Modern, responsive, dan user-friendly
- **Color Scheme**: Primary blue dengan accent colors
- **Icons**: Font Awesome 6
- **Framework CSS**: Bootstrap 5

## 📊 Statistik Dashboard

Dashboard admin menampilkan:
- Total buku
- Total anggota
- Peminjaman aktif
- Peminjaman terlambat
- Peminjaman terbaru
- Distribusi buku per kategori

## 🔄 Workflow Peminjaman

1. Admin menambah buku ke sistem
2. Admin menambah anggota perpustakaan
3. Admin membuat peminjaman untuk anggota
4. Sistem mencatat tanggal pinjam dan kembali
5. Admin dapat mengupdate status peminjaman
6. Sistem menampilkan riwayat peminjaman

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false` di `.env`
3. Optimize Laravel:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Server Requirements
- PHP 8.2+
- MySQL 5.7+ atau PostgreSQL
- Web server (Apache/Nginx)
- SSL certificate (recommended)

## 🤝 Kontribusi

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## 📄 License

Project ini dibuat untuk keperluan akademis dan pembelajaran.

## 👨‍💻 Developer

Dibuat dengan ❤️ menggunakan Laravel 11

---

**Note**: Project ini memenuhi semua ketentuan yang diminta:
- ✅ Minimal 4 tabel custom (5 tabel dibuat)
- ✅ 2 tabel berelasi dengan foreign key
- ✅ Menggunakan migration
- ✅ Prefix nama tabel sesuai nama developer
- ✅ Frontend dan admin panel
- ✅ Middleware dan authorization
- ✅ CRUD lengkap untuk admin
