# Troubleshooting API - Not Found Error

Jika Anda mendapatkan error "404 Not Found" saat mengakses API, ikuti langkah-langkah berikut:

## ✅ Checklist Troubleshooting

### 1. Pastikan Server Berjalan

**Untuk XAMPP:**
- Pastikan Apache berjalan di XAMPP Control Panel
- Pastikan MySQL/MariaDB berjalan (jika menggunakan database)

**Untuk Laravel Development Server:**
```bash
php artisan serve
```
Server akan berjalan di `http://127.0.0.1:8000`

### 2. Cek URL yang Benar

**Format URL yang Benar:**
```
http://localhost/company-profile/api/homepage
```

**Format URL yang SALAH:**
```
❌ http://localhost/api/homepage          (kurang path project)
❌ http://localhost/company-profile/homepage  (kurang /api)
❌ http://127.0.0.1:8000/homepage         (kurang /api)
```

**Untuk XAMPP:**
- Base URL: `http://localhost/company-profile`
- API URL: `http://localhost/company-profile/api/{endpoint}`

**Untuk Laravel Serve:**
- Base URL: `http://127.0.0.1:8000`
- API URL: `http://127.0.0.1:8000/api/{endpoint}`

### 3. Clear Cache Laravel

Jalankan perintah berikut di terminal:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/company-profile
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 4. Cek Route Terdaftar

Jalankan perintah untuk melihat semua route API:

```bash
php artisan route:list --path=api
```

Anda harus melihat route seperti:
- `GET|HEAD api/homepage`
- `GET|HEAD api/portfolios`
- `GET|HEAD api/service-cards`
- dll.

### 5. Test dengan Browser

Buka browser dan akses langsung:
```
http://localhost/company-profile/api/homepage
```

Jika berhasil, Anda akan melihat JSON response.

### 6. Cek File .htaccess

Pastikan file `public/.htaccess` ada dan berisi konfigurasi yang benar.

### 7. Cek Konfigurasi bootstrap/app.php

Pastikan file `bootstrap/app.php` memiliki konfigurasi:

```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',  // ← Pastikan ini ada
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
```

### 8. Cek File routes/api.php

Pastikan file `routes/api.php` ada dan berisi route definitions.

## 🔍 Debugging Steps

### Step 1: Test Route di Browser

Buka browser dan coba akses:
```
http://localhost/company-profile/api/homepage
```

**Jika berhasil:**
- Anda akan melihat JSON response
- Berarti API sudah bekerja dengan benar

**Jika masih 404:**
- Lanjut ke Step 2

### Step 2: Test dengan cURL

Buka terminal dan jalankan:

```bash
curl http://localhost/company-profile/api/homepage
```

**Jika berhasil:**
- Akan muncul JSON response
- Berarti masalah ada di Postman atau browser

**Jika masih 404:**
- Lanjut ke Step 3

### Step 3: Cek Apache Error Log

Cek file log Apache di XAMPP:
```
/Applications/XAMPP/xamppfiles/logs/error_log
```

Atau cek Laravel log:
```
storage/logs/laravel.log
```

### Step 4: Test Route List

Jalankan:
```bash
php artisan route:list --path=api
```

Jika route tidak muncul, berarti ada masalah dengan konfigurasi.

## 🐛 Masalah Umum dan Solusinya

### Masalah 1: "404 Not Found" di Postman

**Kemungkinan Penyebab:**
- URL salah
- Base URL di Postman salah
- Server tidak berjalan

**Solusi:**
1. Pastikan server berjalan
2. Cek URL di Postman: `http://localhost/company-profile/api/homepage`
3. Pastikan tidak ada typo di URL

### Masalah 2: "Route [api/homepage] not defined"

**Kemungkinan Penyebab:**
- Cache route belum di-clear
- File routes/api.php tidak ter-load

**Solusi:**
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### Masalah 3: "Could not get any response" di Postman

**Kemungkinan Penyebab:**
- Server tidak berjalan
- Firewall memblokir
- URL salah

**Solusi:**
1. Pastikan Apache/XAMPP berjalan
2. Test dengan browser dulu
3. Cek firewall settings

### Masalah 4: Response Kosong atau Null

**Kemungkinan Penyebab:**
- Database kosong
- Model tidak terhubung ke database

**Solusi:**
1. Cek apakah database sudah ada datanya
2. Test dengan endpoint yang pasti ada data
3. Cek koneksi database di `.env`

## 📝 Contoh URL yang Benar

### Untuk XAMPP (localhost):
```
✅ http://localhost/company-profile/api/homepage
✅ http://localhost/company-profile/api/portfolios
✅ http://localhost/company-profile/api/service-cards
✅ http://localhost/company-profile/api/hero-sliders
```

### Untuk Laravel Serve:
```
✅ http://127.0.0.1:8000/api/homepage
✅ http://127.0.0.1:8000/api/portfolios
✅ http://127.0.0.1:8000/api/service-cards
```

## 🔧 Quick Fix Commands

Jalankan semua command ini untuk reset semua cache:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/company-profile

# Clear semua cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Optimize (opsional)
php artisan optimize:clear

# Test route
php artisan route:list --path=api
```

## 📞 Masih Bermasalah?

Jika masih bermasalah setelah mengikuti semua langkah di atas:

1. **Cek Laravel Log:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Cek Apache Error Log:**
   ```bash
   tail -f /Applications/XAMPP/xamppfiles/logs/error_log
   ```

3. **Test dengan route sederhana:**
   Tambahkan di `routes/api.php`:
   ```php
   Route::get('/test', function () {
       return response()->json(['message' => 'API works!']);
   });
   ```
   
   Lalu test: `http://localhost/company-profile/api/test`

4. **Pastikan versi Laravel:**
   ```bash
   php artisan --version
   ```


