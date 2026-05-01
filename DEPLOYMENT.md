# Deployment Guide — SIST ke Laravel Cloud

> Target platform: [Laravel Cloud](https://cloud.laravel.com/)
> Database rekomendasi: **PostgreSQL** (Laravel Cloud Managed PostgreSQL atau Supabase)
> Storage rekomendasi: **AWS S3 / DigitalOcean Spaces / Cloudflare R2**

---

## Langkah 1: Connect GitHub ke Laravel Cloud

1. Buka [Laravel Cloud](https://cloud.laravel.com/) dan login
2. Klik **"Create Project"**
3. Pilih **"Import from GitHub"**
4. Authorize Laravel Cloud untuk akses GitHub Anda
5. Pilih repository: **`10Daeng/web-sekolah`**
6. Klik **"Import"**

---

## Langkah 2: Konfigurasi Environment

### 2.1 Environment Variables

Di dashboard Laravel Cloud, masuk ke menu **Environment Variables**, lalu tambahkan:

```env
APP_NAME=SIST
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.laravel.cloud

# Generate APP_KEY baru:
# Jalankan di lokal: php artisan key:generate --show
# Copy value ke environment variable APP_KEY
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxx

# ============================================
# DATABASE — Gunakan PostgreSQL
# ============================================
DB_CONNECTION=pgsql
DB_HOST=your-db-host.laravel.cloud
DB_PORT=5432
DB_DATABASE=sist
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# ============================================
# SESSION & CACHE
# ============================================
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# ============================================
# FILE STORAGE — S3 untuk production
# ============================================
FILESYSTEM_DISK=s3
MEDIA_DISK=s3

AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=sist-production
AWS_ENDPOINT=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### 2.2 Database Setup

**Opsi A: Laravel Cloud Managed PostgreSQL (Recommended)**
1. Di dashboard Laravel Cloud, klik **"Databases"**
2. Klik **"Create Database"** → Pilih **PostgreSQL**
3. Copy connection details ke environment variables

**Opsi B: Supabase PostgreSQL**
1. Buat project di [Supabase](https://supabase.com)
2. Settings → Database → Connection String
3. Parse ke format environment variables Laravel Cloud

---

## Langkah 3: First Deploy

### 3.1 Trigger Deploy

Laravel Cloud akan otomatis deploy saat Anda push ke branch `main`:

```bash
# Di lokal machine
# Pastikan semua perubahan sudah di-push ke GitHub
git push origin main
```

Atau trigger manual deploy dari dashboard Laravel Cloud.

### 3.2 Post-Deploy Commands (Console)

Setelah deploy berhasil, buka **Console** di Laravel Cloud dashboard, lalu jalankan:

```bash
# Jalankan migrasi (membuat tabel)
php artisan migrate --force

# Jalankan seeder (HANYA first deploy!)
# Ini akan membuat akun default:
# - Super Admin: admin@sist.test / password
# - Admin TU: tu@sist.test / password
php artisan db:seed --force

# Optimize Laravel
php artisan optimize

# Upgrade Filament assets
php artisan filament:upgrade
```

---

## Langkah 4: Storage Setup

### 4.1 S3/Cloud Storage

1. Buat bucket di AWS S3 / DigitalOcean Spaces / Cloudflare R2
2. Set CORS policy agar bisa diakses dari domain Laravel Cloud Anda
3. Copy credentials ke environment variables
4. Tidak perlu `php artisan storage:link` di Laravel Cloud

### 4.2 Permission Bucket

- **Galeri & Berita**: Public read
- **Dokumen PPDB**: Private (dihandle oleh Laravel authorization)

---

## Langkah 5: Domain & SSL

1. Di Laravel Cloud dashboard, masuk ke **Domains**
2. Tambahkan custom domain (opsional) atau gunakan default `.laravel.cloud`
3. SSL certificate akan auto-provisioned oleh Laravel Cloud

---

## Checklist Pre-Deploy

- [x] Kode sudah di-push ke GitHub
- [x] Repository sudah di-connect ke Laravel Cloud
- [x] Environment variables sudah diisi lengkap
- [x] Database PostgreSQL sudah tersedia
- [x] S3 bucket sudah dibuat (jika pakai file upload)
- [x] `APP_DEBUG=false`
- [x] `APP_KEY` sudah digenerate

---

## Troubleshooting

| Error | Solusi |
|-------|--------|
| `SQLSTATE[08006]` | Cek DB_HOST dan pastikan database allow connection dari Laravel Cloud |
| `Missing S3 credentials` | Pastikan AWS_ACCESS_KEY_ID dan AWS_SECRET_ACCESS_KEY terisi |
| `File not found` setelah upload | Cek FILESYSTEM_DISK=s3 di environment variables |
| Filament tidak muncul | Jalankan `php artisan filament:upgrade` di console |
| Assets tidak load | Clear cache: `php artisan optimize:clear` |

---

## Referensi

- [Laravel Cloud Documentation](https://cloud.laravel.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/11.x/deployment)
- [Spatie Media Library — Working with S3](https://spatie.be/docs/laravel-medialibrary/v11/working-with-media-on-s3)
