# DEVELOPER TIPS & TRICKS

## 📚 Quick References

### Membuat Route Baru
```php
// routes/web.php
Route::get('/path', [ControllerName::class, 'method'])->name('route.name');
Route::post('/path', [ControllerName::class, 'store'])->name('route.store');
Route::resource('/resource', ResourceController::class);
```

### Membuat Model dengan Migration
```bash
php artisan make:model ModelName -m
```

### Membuat Controller
```bash
php artisan make:controller ControllerName
```

### Membuat Middleware
```bash
php artisan make:middleware MiddlewareName
```

---

## 🔧 Useful Commands

```bash
# Clear all cache
php artisan optimize:clear

# Clear config cache
php artisan config:cache

# Clear route cache
php artisan route:cache

# Refresh database
php artisan migrate:refresh --seed

# Run tinker (interactive shell)
php artisan tinker

# Generate app key
php artisan key:generate

# Lint check
php artisan tinker
```

---

## 📝 Extending the System

### Tambah Role Baru
1. Update enum di migration users
2. Buat middleware baru (IsNewRole.php)
3. Daftarkan di Kernel.php
4. Gunakan di routes

### Tambah Field Siswa
1. Create migration: `php artisan make:migration add_field_to_siswas`
2. Update Siswa model fillable
3. Update controller validation
4. Update blade template

### Tambah DUDI Field
1. Similar ke siswa
2. Update Dudi model
3. Update admin DUDI forms

---

## 🧪 Testing Tips

### Test Login
```php
// Di Tinker
$user = \App\Models\User::where('username', 'gwadmin')->first();
Auth::login($user);
```

### Check Database
```php
// Di Tinker
\App\Models\Siswa::all();
\App\Models\Booking::with('siswa', 'dudi')->get();
```

### Reset User Password
```php
// Di Tinker
$user = \App\Models\User::find(1);
$user->password = Hash::make('newpassword');
$user->save();
```

---

## 🎨 CSS Customization

### Ubah Primary Color
Edit di `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-color: #003056; /* ubah ke warna lain */
}
```

### Tambah Component Baru
Buat di blade template dengan style yang konsisten:
```blade
<div class="card">
    <div class="card-header">
        <h2>Title</h2>
    </div>
    <!-- content -->
</div>
```

---

## 📄 File Upload Tips

### Directory Upload
Default: `storage/app/public/berkas`

### Serve Files
Files dapat diakses via: `/storage/berkas/filename`

### Cleanup Old Files
```php
// Di controller atau command
Storage::disk('public')->delete('berkas/old_file.pdf');
```

---

## 🔐 Security Checklist

Before production:
- [ ] Change .env APP_KEY
- [ ] Set APP_DEBUG=false
- [ ] Update database credentials
- [ ] Setup HTTPS/SSL
- [ ] Enable rate limiting
- [ ] Backup database regularly
- [ ] Monitor logs

---

## 📊 Performance Tips

### Database Query Optimization
```php
// GOOD - Eager loading
$bookings = Booking::with(['siswa', 'dudi'])->get();

// AVOID - N+1 queries
$bookings = Booking::all();
foreach($bookings as $booking) {
    echo $booking->siswa->nama; // Query per loop!
}
```

### Cache Frequently Accessed Data
```php
$dudis = Cache::remember('dudis', 3600, function () {
    return Dudi::all();
});
```

---

## 🐛 Debugging

### Enable Debug Mode
```php
// .env
APP_DEBUG=true
```

### Use Laravel Debugbar (optional install)
```bash
composer require barryvdh/laravel-debugbar --dev
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 📱 Mobile Optimization

Current system sudah responsive. Untuk improvement:

1. **PWA (Progressive Web App)**
   - Install web.php manifest
   - Service worker untuk offline mode

2. **Push Notifications**
   - Notifikasi untuk status booking berubah
   - Perlu integration dengan push service

3. **Native Mobile App**
   - Develop with React Native atau Flutter
   - Gunakan API endpoints

---

## 🚀 Deployment Checklist

### Pre-Deployment
```bash
# Test production build
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Production Setup
```bash
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Setup proper database
# Update .env dengan production DB credentials

# Run migrations
php artisan migrate --force

# Backup database sebelum production
```

---

## 📚 Learning Resources

- Laravel Docs: https://laravel.com/docs
- Blade Docs: https://laravel.com/docs/blade
- Eloquent Docs: https://laravel.com/docs/eloquent
- Database: https://laravel.com/docs/database

---

## 💡 Common Issues & Solutions

### Issue: View not found
```
- Check path spelling
- Clear view cache: php artisan view:clear
- Ensure blade file exists
```

### Issue: Route not found
```
- Check route defined in web.php
- Clear route cache: php artisan route:clear
- Check controller exists
```

### Issue: Database connection failed
```
- Check .env database config
- Ensure database file exists (SQLite)
- Check MySQL running
```

### Issue: File upload failed
```
- Check storage permissions
- Ensure public/storage symlink exists
- Check file size limit
```

---

## 🎯 Feature Enhancement Ideas

1. **Email Notifications**
   - Send email when booking status changes
   - Integration dengan Mailer

2. **PDF Export**
   - Export booking list as PDF
   - Generate acceptance letter

3. **SMS Notifications**
   - Notifikasi via SMS (optional)
   - Integration dengan SMS gateway

4. **Analytics Dashboard**
   - Charts untuk booking trend
   - Statistics per DUDI
   - Statistics per bulan

5. **Advanced Filtering**
   - Filter by date range
   - Filter by multiple criteria
   - Saved filters

6. **User Permissions**
   - Fine-grained permission system
   - Role-based features access

7. **Audit Log**
   - Track siapa yang ubah apa
   - Timestamps untuk semua actions

---

## 🔄 Git Workflow

```bash
# Create feature branch
git checkout -b feature/feature-name

# Make changes and commit
git add .
git commit -m "Add feature description"

# Push to repository
git push origin feature/feature-name

# Create pull request (for team projects)
```

---

**Happy Coding! 🚀**
