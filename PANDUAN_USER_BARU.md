# Panduan Login User Baru

## Akun User yang Telah Dibuat

### 1. Wali Kelas XII SIJA 1
- **Username**: `wali_kelas_1`
- **Password**: `password123`
- **Role**: Wali Kelas
- **Akses**: Dapat melihat data kelas XII SIJA 1 saja
- **URL Dashboard**: `/wali-kelas/dashboard`

### 2. Wali Kelas XII SIJA 2
- **Username**: `wali_kelas_2`
- **Password**: `password123`
- **Role**: Wali Kelas
- **Akses**: Dapat melihat data kelas XII SIJA 2 saja
- **URL Dashboard**: `/wali-kelas/dashboard`

### 3. Kakonsli (Ketua Konsentrasi Keahlian)
- **Username**: `kakonsli`
- **Password**: `password123`
- **Role**: Kakonsli
- **Akses**: Dapat melihat data KEDUA kelas (XII SIJA 1 dan XII SIJA 2)
- **URL Dashboard**: `/kakonsli/dashboard`

## Fitur yang Tersedia

### Dashboard Wali Kelas
- Melihat statistik siswa dan booking di kelasnya
- Melihat daftar siswa di kelas
- Melihat daftar booking di kelas
- Status booking (Direview, Diterima, Ditolak)

### Dashboard Kakonsli
- Melihat statistik siswa dan booking dari KEDUA kelas
- Melihat daftar siswa dari kedua kelas dengan badge warna berbeda
- Melihat daftar booking dari kedua kelas
- Status booking dari kedua kelas

## Struktur Database

### Tabel Users - Kolom Baru
- `kelas_id`: Kelas utama yang dapat diakses (untuk wali_kelas dan kakonsli)
- `kelas_second`: Kelas kedua yang dapat diakses (khusus kakonsli)
- `role`: Enum dengan nilai `admin`, `siswa`, `wali_kelas`, `kakonsli`

## Middleware dan Authorization
- **IsWaliKelas**: Middleware untuk melindungi routes wali kelas
- **IsKakonsli**: Middleware untuk melindungi routes kakonsli
- Semua routes dilindungi dengan `auth` middleware

## Routes yang Tersedia

### Wali Kelas Routes
```
/wali-kelas/dashboard      - Dashboard wali kelas
/wali-kelas/siswas        - Daftar siswa
/wali-kelas/bookings      - Daftar booking
```

### Kakonsli Routes
```
/kakonsli/dashboard        - Dashboard kakonsli
/kakonsli/siswas          - Daftar siswa (kedua kelas)
/kakonsli/bookings        - Daftar booking (kedua kelas)
```

## Catatan
- Password semua akun adalah `password123` (gunakan sesuai kebutuhan)
- Wali kelas hanya bisa melihat 1 kelas sesuai assignment
- Kakonsli bisa melihat kedua kelas untuk monitoring keseluruhan
- Ketika login, sistem otomatis redirect ke dashboard sesuai role
