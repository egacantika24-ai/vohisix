# 🎓 Website Booking PKL SIJA – SMK Negeri 6

Sistem manajemen booking PKL (Praktik Kerja Lapangan) berbasis Laravel untuk memudahkan proses pendaftaran siswa secara transparan, terstruktur, dan terdokumentasi.

## ✨ Fitur Utama

### 👨‍💼 Admin Panel
- 📊 Dashboard dengan statistik lengkap
- 👥 Kelola data siswa (CRUD + search)
- 🏢 Kelola perusahaan DUDI (CRUD + search)
- 📋 Review & update status booking PKL
- 🔐 Manajemen akun login user

### 👨‍🎓 Siswa Panel
- 📝 Dashboard siswa dengan overview
- 📄 Upload berkas administrasi PKL
- 🔍 Search & browse DUDI
- 📮 Ajukan PKL ke DUDI pilihan
- 📊 Pantau status booking PKL

## 🚀 Quick Start

### Prerequisites
- PHP 8.0+
- Composer
- SQLite atau MySQL

### Installation

```bash
# 1. Clone atau buka directory project
cd c:\laravel1\vohisix

# 2. Install dependencies
composer install

# 3. Setup environment file
cp .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate --force
php artisan db:seed
php artisan storage:link

# 5. Run server
php artisan serve
```

Akses aplikasi di: **http://127.0.0.1:8000**

## 🔐 Akun Login Default

### Admin
```
Username: gwadmin
Password: acm
```

### Siswa (Sample)
```
Username: 001 (NIS)
Password: 001 (NIS)
```

> Akun siswa lain: 002-005 dengan password sesuai NIS

## 📊 Teknologi Stack

- **Framework**: Laravel 9+
- **Database**: SQLite (dev) / MySQL (production)
- **Template Engine**: Blade
- **Styling**: Pure CSS (tanpa framework UI)
- **Database ORM**: Eloquent

## 📁 Project Structure

```
app/
├── Models/          # Eloquent Models
├── Http/
│   ├── Controllers/ # Business Logic
│   └── Middleware/  # Auth & Role Middleware
database/
├── migrations/      # Database Schema
└── seeders/        # Sample Data
resources/views/
├── auth/           # Login Page
├── admin/          # Admin Panel Pages
└── siswa/          # Siswa Panel Pages
routes/web.php      # Route Configuration
```

## 🎨 Design Features

- **Theme Color**: #003056 (Biru Tua Elegan)
- **Responsive Design**: Mobile, Tablet, Desktop
- **Hamburger Menu**: Sidebar navigation
- **Clean UI**: Modern & Professional
- **Smooth Animations**: Hover effects & transitions

## 📝 Dokumentasi Lengkap

- **[DOKUMENTASI.md](DOKUMENTASI.md)** - Panduan lengkap sistem
- **[TESTING.md](TESTING.md)** - Testing guide untuk semua fitur
- **[IMPLEMENTASI.md](IMPLEMENTASI.md)** - Detail implementasi & architecture

## ✅ Features Checklist

- ✅ Dual role authentication (Admin & Siswa)
- ✅ Admin: CRUD Siswa, DUDI, Booking, User
- ✅ Admin: Dashboard dengan statistik
- ✅ Siswa: Upload berkas administrasi
- ✅ Siswa: Browse & search DUDI
- ✅ Siswa: Ajukan PKL ke DUDI
- ✅ Siswa: Monitor status booking
- ✅ Validasi berkas otomatis
- ✅ Search & pagination
- ✅ Responsive design
- ✅ Role-based access control
- ✅ Security: CSRF, validation, hashing

## 📱 Browser Support

- Chrome/Chromium (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## 🐛 Troubleshooting

### Database Error
```bash
# Reset database
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:cache
```

### Storage Issues
```bash
php artisan storage:link
chmod -R 775 storage
```

## 📧 Support

Untuk pertanyaan atau masalah, silakan hubungi administrator sistem.

## 📄 License

Aplikasi ini dibuat untuk SMK Negeri 6. Semua hak dilindungi.

---

**Website Booking PKL SIJA** | Dibuat: February 2, 2026 | Status: ✅ COMPLETE

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
