# Testing Guide - Website Booking PKL

## 🧪 Panduan Testing Fitur

Panduan ini untuk test semua fitur sistem Website Booking PKL.

---

## 1. LOGIN & AUTHENTICATION

### Test Admin Login
1. Buka `http://127.0.0.1:8000`
2. Masuk sebagai Admin
   - Username: `gwadmin`
   - Password: `acm`
3. ✓ Akan redirect ke Admin Dashboard

### Test Siswa Login
1. Buka `http://127.0.0.1:8000`
2. Masuk sebagai Siswa
   - Username: `001`
   - Password: `001`
3. ✓ Akan redirect ke Siswa Dashboard

### Test Invalid Login
1. Masuk dengan username/password yang salah
2. ✓ Tampil error message

### Test Logout
1. Klik "Logout" di navbar
2. ✓ Redirect ke login page

---

## 2. ADMIN PANEL

### 2.1 Dashboard Admin
✓ Tampil statistik:
- Total Siswa
- Total DUDI
- Total Booking
- Booking Direview/Diterima/Ditolak

### 2.2 Kelola Siswa PKL

#### Create Siswa
1. Buka Admin → Siswa PKL → Tambah Siswa
2. Isi form:
   - NIS: `006`
   - Nama: `Test Siswa`
   - Kelas: `12 SIJA 1`
   - Password: `password123`
3. ✓ Siswa berhasil ditambahkan
4. ✓ User otomatis dibuat
5. ✓ Berkas otomatis dibuat

#### Read Siswa
1. Lihat daftar siswa dengan pagination
2. ✓ Menampilkan: No, Foto, Nama, NIS, Kelas
3. ✓ Tombol Edit & Hapus tersedia

#### Update Siswa
1. Klik Edit pada salah satu siswa
2. Ubah Nama atau Kelas
3. ✓ Data berhasil diperbarui

#### Delete Siswa
1. Klik Hapus pada salah satu siswa
2. Confirm dialog muncul
3. ✓ Siswa & user terkait terhapus

#### Search Siswa
1. Cari siswa dengan keyword
2. ✓ Filter berdasarkan nama/NIS/kelas

### 2.3 Kelola DUDI

#### Create DUDI
1. Buka Admin → Perusahaan (DUDI) → Tambah DUDI
2. Isi form lengkap
3. ✓ DUDI berhasil ditambahkan

#### Read DUDI
1. Lihat daftar DUDI dengan pagination
2. ✓ Menampilkan: No, Nama, Bidang, Alamat, Telepon

#### Update DUDI
1. Klik Edit pada DUDI
2. Update data
3. ✓ Perubahan tersimpan

#### Delete DUDI
1. Klik Hapus pada DUDI
2. ✓ DUDI terhapus

#### Search DUDI
1. Cari dengan nama atau bidang usaha
2. ✓ Filter bekerja

### 2.4 Kelola Booking PKL

#### Read Booking
1. Buka Admin → Booking PKL
2. ✓ Lihat daftar booking dengan status

#### Filter Booking
1. Gunakan filter status (Direview/Diterima/Ditolak)
2. ✓ List terupdate sesuai filter

#### Update Status Booking
1. Klik Edit pada booking
2. Pilih status:
   - Direview
   - Diterima
   - Ditolak
3. ✓ Status berhasil diperbarui

#### Delete Booking
1. Klik Hapus pada booking
2. ✓ Booking terhapus

#### Search Booking
1. Cari dengan nama siswa atau NIS
2. ✓ Filter bekerja

### 2.5 Manajemen Login

#### Create User
1. Buka Admin → Manajemen Login → Tambah User
2. Isi:
   - Username: unique
   - Nama: nama user
   - Role: admin/siswa
   - Password: password
3. ✓ User berhasil dibuat

#### Read User
1. Lihat daftar user
2. ✓ Menampilkan: No, Username, Nama, Role

#### Update User
1. Klik Edit user
2. Update nama/role/password
3. ✓ Perubahan tersimpan

#### Delete User
1. Klik Hapus user
2. ✓ User terhapus
3. ⚠️ Sistem cegah hapus admin terakhir

---

## 3. SISWA PANEL

### 3.1 Dashboard Siswa
✓ Tampil:
- Status berkas (Lengkap/Belum Lengkap)
- Total booking
- Total diterima
- Info siswa

### 3.2 Siswa PKL (Upload Berkas)

#### Upload Berkas
1. Buka Siswa → Siswa PKL
2. Upload 5 berkas:
   - KTP/KIA
   - Surat Sehat
   - Kartu BPJS
   - Surat Balasan
   - Buku Tabungan
3. ✓ Berkas berhasil diupload
4. ✓ Status berkas berubah menjadi LENGKAP

#### Partial Upload
1. Upload hanya beberapa berkas
2. ✓ Status tetap BELUM LENGKAP

### 3.3 Perusahaan (DUDI)

#### Lihat Daftar DUDI
1. Buka Siswa → Perusahaan (DUDI)
2. ✓ Tampil card DUDI dengan info
3. ✓ Pagination bekerja

#### Search DUDI
1. Cari dengan keyword
2. ✓ Filter hasil

#### Lihat Detail DUDI
1. Klik tombol detail
2. ✓ Tampil informasi lengkap DUDI

#### Ajukan PKL
1. Di halaman detail DUDI, klik "Ajukan PKL"
2. Jika berkas lengkap: ✓ Ajukan berhasil
3. Jika berkas belum lengkap: ✗ Error message

#### Cegah Duplikasi
1. Coba ajukan ke DUDI yang sudah pernah diajukan
2. ✓ Sistem tampil warning "sudah mengajukan"

### 3.4 Booking PKL (Status)

#### Lihat Status Booking
1. Buka Siswa → Booking PKL
2. ✓ Tampil daftar booking dengan status
3. ✓ Status badge: Direview (kuning), Diterima (hijau), Ditolak (merah)

#### Monitoring Status
1. Lihat perubahan status dari ajukan hingga final
2. ✓ Update real-time setelah admin ubah

---

## 4. UI/UX TESTING

### 4.1 Responsive Design
- [ ] Buka di Desktop - ✓ Responsive
- [ ] Buka di Tablet - ✓ Responsive
- [ ] Buka di Mobile - ✓ Responsive

### 4.2 Navigation
- [ ] Hamburger menu responsive di mobile
- [ ] Sidebar toggle berfungsi
- [ ] Semua link navigasi bekerja
- [ ] Breadcrumb menunjukkan path

### 4.3 Styling
- [ ] Tema warna #003056 konsisten
- [ ] Font rapi dan readable
- [ ] Button hover effects smooth
- [ ] Form input styling konsisten

### 4.4 Alerts & Notifications
- [ ] Success message tampil
- [ ] Error message tampil
- [ ] Warning message tampil
- [ ] Notif otomatis hilang

---

## 5. DATABASE TESTING

### Check Database
```bash
# Lihat struktur database
php artisan tinker
>>> DB::connection()->getDatabaseName()
>>> \App\Models\User::count()
>>> \App\Models\Siswa::count()
>>> \App\Models\Dudi::count()
```

### Reset Database (jika diperlukan)
```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

---

## 6. EDGE CASES

### Test Data Validation
- [ ] Submit form kosong → Error
- [ ] Masuk password salah → Error
- [ ] Duplicate NIS → Error
- [ ] Invalid email → Error

### Test Authorization
- [ ] Siswa akses admin routes → Redirect
- [ ] Admin akses siswa routes → Redirect
- [ ] Non-login user akses app → Redirect ke login

### Test File Upload
- [ ] Upload file besar > 2MB → Error
- [ ] Upload format invalid → Error
- [ ] Upload valid file → Success

---

## 7. PERFORMANCE TESTING

### Load Time
- [ ] Login page < 2s
- [ ] Admin dashboard < 3s
- [ ] Daftar siswa dengan 100+ data ✓ Smooth

### Pagination
- [ ] 10 items per page
- [ ] Navigate page bekerja
- [ ] Query efficient

---

## 📋 Checklist Final

- [ ] Semua routes berfungsi
- [ ] Semua controller bekerja
- [ ] Semua view render benar
- [ ] Database operations berhasil
- [ ] Authentication sistem
- [ ] Authorization role-based
- [ ] Error handling
- [ ] Responsive design
- [ ] Form validation
- [ ] File upload

---

## 🐛 Known Issues & Fixes

Jika ditemukan issue:
1. Check console browser (F12)
2. Check server logs
3. Periksa database connection
4. Clear cache: `php artisan cache:clear`

---

**Testing Complete! ✓**
