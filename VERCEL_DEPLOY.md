# Panduan Deploy Website ke Vercel

## Prasyarat

1. **Akun Vercel**: Daftar di [vercel.com](https://vercel.com) (gratis)
2. **Git Repository**: Pastikan proyek sudah di-push ke GitHub, GitLab, atau Bitbucket
3. **Vercel CLI** (opsional): Install dengan `npm i -g vercel`

## Langkah-langkah Deploy

### Metode 1: Deploy via Vercel Dashboard (Recommended)

1. **Login ke Vercel**
   - Buka [vercel.com](https://vercel.com)
   - Login dengan GitHub/GitLab/Bitbucket

2. **Import Project**
   - Klik "Add New..." → "Project"
   - Pilih repository yang berisi proyek ini
   - Klik "Import"

3. **Konfigurasi Project**
   - **Framework Preset**: Pilih "Other" atau biarkan auto-detect
   - **Root Directory**: Biarkan kosong (atau `.` jika diperlukan)
   - **Build Command**: `composer install --no-dev --optimize-autoloader && npm install && npm run build`
   - **Output Directory**: `public`
   - **Install Command**: `composer install --no-dev --optimize-autoloader && npm install`

4. **Environment Variables**
   Klik "Environment Variables" dan tambahkan variabel berikut:
   
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-project-name.vercel.app
   APP_KEY=base64:TGaVaXwhWgjn9akhE4SCSIjGG/cQqvICUQ+PgLA3Bs0=
   
   APP_CONFIG_CACHE=/tmp/config.php
   APP_EVENTS_CACHE=/tmp/events.php
   APP_PACKAGES_CACHE=/tmp/packages.php
   APP_ROUTES_CACHE=/tmp/routes.php
   APP_SERVICES_CACHE=/tmp/services.php
   VIEW_COMPILED_PATH=/tmp
   
   CACHE_DRIVER=array
   LOG_CHANNEL=stderr
   SESSION_DRIVER=cookie
   
   DB_CONNECTION=mysql
   DB_HOST=4gg.h.filess.io
   DB_PORT=3306
   DB_DATABASE=db2024_stormtorn
   DB_USERNAME=db2024_stormtorn
   DB_PASSWORD=your_database_password
   ```

   **PENTING**: 
   - Ganti `APP_URL` dengan URL Vercel Anda setelah deploy
   - Ganti `DB_PASSWORD` dengan password database yang benar
   - Set semua environment variables untuk **Production**, **Preview**, dan **Development**

5. **Deploy**
   - Klik "Deploy"
   - Tunggu proses build selesai
   - Website akan otomatis live di URL yang diberikan Vercel

### Metode 2: Deploy via Vercel CLI

1. **Install Vercel CLI**
   ```bash
   npm i -g vercel
   ```

2. **Login ke Vercel**
   ```bash
   vercel login
   ```

3. **Deploy**
   ```bash
   vercel
   ```
   
   Ikuti instruksi yang muncul:
   - Set up and deploy? **Y**
   - Which scope? Pilih akun Anda
   - Link to existing project? **N** (untuk pertama kali)
   - Project name? Masukkan nama proyek
   - Directory? Tekan Enter (default)
   - Override settings? **N**

4. **Set Environment Variables**
   ```bash
   vercel env add APP_ENV
   vercel env add APP_DEBUG
   vercel env add APP_URL
   vercel env add APP_KEY
   vercel env add DB_CONNECTION
   vercel env add DB_HOST
   vercel env add DB_PORT
   vercel env add DB_DATABASE
   vercel env add DB_USERNAME
   vercel env add DB_PASSWORD
   ```
   
   Masukkan nilai untuk setiap variabel saat diminta.

5. **Deploy Production**
   ```bash
   vercel --prod
   ```

## Setelah Deploy

1. **Update APP_URL**
   - Setelah deploy selesai, copy URL dari Vercel
   - Update environment variable `APP_URL` di Vercel dashboard dengan URL tersebut
   - Redeploy untuk menerapkan perubahan

2. **Storage Configuration**
   - Vercel menggunakan filesystem read-only
   - Untuk file upload, gunakan external storage seperti:
     - AWS S3
     - Cloudinary
     - Supabase Storage
     - Atau service storage lainnya

3. **Database**
   - Pastikan database MySQL dapat diakses dari internet
   - Whitelist IP Vercel jika diperlukan
   - Atau gunakan database hosting yang mendukung remote connection

## Troubleshooting

### Error: Composer not found
- Pastikan `buildCommand` di `vercel.json` sudah benar
- Vercel akan otomatis install Composer

### Error: Database connection failed
- Pastikan database dapat diakses dari internet
- Check firewall settings
- Verify credentials di environment variables

### Error: 500 Internal Server Error
- Check logs di Vercel dashboard
- Pastikan semua environment variables sudah di-set
- Pastikan `APP_KEY` sudah di-generate

### Assets tidak muncul
- Pastikan `npm run build` berhasil
- Check path di `vite.config.js`
- Pastikan route `/build/(.*)` di `vercel.json` benar

## Catatan Penting

1. **File Storage**: Vercel menggunakan filesystem read-only. File yang di-upload tidak akan tersimpan permanen. Gunakan external storage service.

2. **Session**: Menggunakan `SESSION_DRIVER=cookie` karena Vercel tidak mendukung file-based session.

3. **Cache**: Menggunakan `CACHE_DRIVER=array` karena Vercel tidak mendukung file-based cache. Untuk production, pertimbangkan Redis atau cache service lainnya.

4. **Logs**: Logs akan muncul di Vercel dashboard → Project → Logs

5. **Auto Deploy**: Setiap push ke branch `main` akan otomatis trigger deploy baru.

## Update Website

Setelah perubahan kode:
1. Push ke repository
2. Vercel akan otomatis deploy (jika auto-deploy enabled)
3. Atau deploy manual via dashboard/CLI

---

**Selamat! Website Anda sudah live di Vercel! 🚀**

