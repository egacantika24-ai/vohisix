# Website Booking PKL Jurusan SIJA – SMK Negeri 6

Sistem manajemen booking PKL (Praktik Kerja Lapangan) untuk memudahkan proses pendaftaran siswa secara transparan, terstruktur, dan terdokumentasi.

## 🎯 Fitur Utama

### Untuk Admin
- **Dashboard Admin**: Menampilkan statistik dan overview sistem
- **Kelola Siswa PKL**: CRUD data siswa, upload foto, manage data
- **Kelola DUDI**: CRUD data perusahaan tempat PKL
- **Kelola Booking**: Review, update status (Direview/Diterima/Ditolak), hapus
- **Manajemen Login**: CRUD akun user (Admin & Siswa)

### Untuk Siswa
- **Dashboard Siswa**: Overview data siswa dan status PKL
- **Siswa PKL**: Upload berkas administrasi PKL
- **Cari DUDI**: Browse daftar perusahaan, search, lihat detail
- **Ajukan PKL**: Submit aplikasi PKL ke perusahaan pilihan
- **Status Booking**: Monitor status pengajuan PKL

## 🔐 Akun Login

### Admin
- **Username**: `gwadmin`
- **Password**: `acm`

### Siswa (Contoh)
- **Username**: `001` (NIS)
- **Password**: `001` (NIS)

(Akun siswa dapat ditambahkan melalui halaman Manajemen Login di Admin Panel)

## 📋 Requirement Berkas PKL Siswa

Siswa HARUS mengupload berkas berikut sebelum dapat mengajukan PKL:
1. Fotocopy KTP / KIA
2. Surat Keterangan Sehat dari UKS
3. Kartu BPJS Ketenagakerjaan
4. Surat Balasan Kesediaan Menerima Siswa PKL (Asli)
5. Buku Tabungan / Simpanan Pelajar

## 🛠️ Teknologi & Framework

- **Laravel 9+**: PHP Framework
- **Blade Template**: View Engine
- **SQLite**: Database (untuk development)
- **CSS Pure**: Styling (tanpa Tailwind)

## 📦 Struktur Project

```
app/
├── Models/
│   ├── User.php          # Model untuk user (admin & siswa)
│   ├── Siswa.php         # Model data siswa
│   ├── Dudi.php          # Model perusahaan DUDI
│   ├── Booking.php       # Model booking PKL
│   └── Berkas.php        # Model berkas administrasi
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── AdminDashboardController.php
│   │   ├── AdminSiswaController.php
│   │   ├── AdminDudiController.php
│   │   ├── AdminBookingController.php
│   │   ├── AdminLoginController.php
│   │   ├── SiswaDashboardController.php
│   │   ├── SiswaPklController.php
│   │   ├── SiswaDudiController.php
│   │   └── SiswaBookingController.php
│   └── Middleware/
│       ├── IsAdmin.php    # Middleware untuk role admin
│       └── IsSiswa.php    # Middleware untuk role siswa
database/
├── migrations/           # Database migrations
└── seeders/
    └── DatabaseSeeder.php
resources/
└── views/
    ├── auth/
    │   └── login.blade.php
    ├── layouts/
    │   └── app.blade.php  # Layout utama
    ├── admin/
    │   ├── dashboard.blade.php
    │   ├── siswa/
    │   ├── dudi/
    │   ├── booking/
    │   └── login/
    └── siswa/
        ├── dashboard.blade.php
        ├── pkl/
        ├── dudi/
        └── booking/
routes/
└── web.php              # Konfigurasi routes
```

## 🚀 Instalasi & Setup

### 1. Clone Repository
```bash
cd c:\laravel1\vohisix
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Migration
```bash
php artisan migrate --force
```

### 5. Seed Database
```bash
php artisan db:seed
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Run Server
```bash
php artisan serve
```

Akses aplikasi di: `http://127.0.0.1:8000`

## 📱 Responsive Design

Aplikasi dirancang responsive dan dapat diakses dari:
- 💻 Desktop & Laptop
- 📱 Tablet
- 📲 Mobile Phone

## 🎨 Tema & Warna

- **Primary Color**: `#003056` (Biru Tua Elegan)
- **Secondary Color**: `#004e8c`
- **Background**: `#f8f9fa`
- **Font**: Segoe UI, Tahoma, Geneva, Verdana

## 🔄 Alur Sistem

### Alur Siswa
1. Login dengan NIS
2. Lengkapi berkas administrasi (Siswa PKL)
3. Cari DUDI dan lihat detail
4. Ajukan PKL ke DUDI pilihan
5. Pantau status booking PKL

### Alur Admin
1. Login dengan admin account
2. Kelola data siswa (CRUD)
3. Kelola data DUDI (CRUD)
4. Review dan update status booking
5. Manage akun user

## 📊 Database Schema

### Users Table
- id
- username (unique)
- name
- role (admin/siswa)
- password
- remember_token
- timestamps

### Siswas Table
- nis (primary key)
- nama
- kelas
- foto
- timestamps

### Dudis Table
- id_dudi (primary key)
- nama_dudi
- alamat
- telepon
- email
- deskripsi
- bidang_usaha
- timestamps

### Bookings Table
- id_booking (primary key)
- nis (foreign key)
- id_dudi (foreign key)
- status (Direview/Diterima/Ditolak)
- timestamps

### Berkas Table
- id
- nis (foreign key)
- ktp_kia
- surat_sehat
- kartu_bpjs
- surat_balasan
- buku_tabungan
- lengkap (boolean)
- timestamps

## ✨ Fitur Khusus

### Validasi Berkas
- Sistem otomatis cek kelengkapan berkas
- Siswa tidak bisa ajukan PKL jika berkas belum lengkap
- Admin bisa lihat status berkas siswa

### Status Booking
- **Direview**: Sedang diproses admin
- **Diterima**: Pengajuan diterima DUDI
- **Ditolak**: Pengajuan ditolak DUDI

### Search & Filter
- Search siswa by nama/NIS
- Search DUDI by nama/bidang usaha
- Filter booking by status

## 🛡️ Security

- Authentication middleware untuk protected routes
- Role-based access control (admin/siswa)
- CSRF protection
- Password hashing dengan bcrypt

## 📝 Notes

- Beberapa layout detail dapat disesuaikan sesuai kebutuhan
- Fokus pada kerangka sistem dan alur logika
- CSS pure tanpa framework UI
- Animasi ringan untuk user experience yang baik

## 📧 Support

Untuk pertanyaan atau masalah, silakan hubungi administrator sistem.

---

**Website Booking PKL SIJA** | SMK Negeri 6 | 2026
