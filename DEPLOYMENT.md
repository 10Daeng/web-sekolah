# Deployment Guide — SIST ke Laravel Cloud

> Target platform: [Laravel Cloud](https://cloud.laravel.com/)
> Database rekomendasi: **PostgreSQL** (Laravel Cloud Managed PostgreSQL atau Supabase)
> Storage rekomendasi: **AWS S3 / DigitalOcean Spaces / Cloudflare R2**

---

## 1. Persiapan Environment

### 1.1 Clone & Install Dependency

```bash
# Clone repository (atau gunakan existing)
git clone <repo-url> sist
cd sist

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node dependencies (jika pakai Vite/build assets)
npm install && npm run build
```

### 1.2 File Environment Production

Salin `.env.example` ke `.env` dan sesuaikan:

```bash
cp .env.example .env
php artisan key:generate
```

**Konfigurasi wajib untuk Laravel Cloud:**

```env
APP_NAME=SIST
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.laravel.cloud

# ============================================
# DATABASE — Gunakan PostgreSQL (Recommended)
# ============================================
DB_CONNECTION=pgsql
DB_HOST=your-db-host.laravel.cloud      # dari Laravel Cloud dashboard
DB_PORT=5432
DB_DATABASE=sist
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# ============================================
# SESSION & CACHE — Gunakan database atau Redis
# ============================================
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# ============================================
# FILE STORAGE — S3/Cloud untuk production
# ============================================
FILESYSTEM_DISK=s3
MEDIA_DISK=s3

AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=sist-production
AWS_ENDPOINT=                          # kosong untuk AWS S3, isi untuk DO Spaces / R2
AWS_USE_PATH_STYLE_ENDPOINT=false
```

> **Catatan SQLite:** Jangan gunakan SQLite untuk production. Hanya untuk local development.

---

## 2. Database Setup

### 2.1 Pilihan A: Laravel Cloud Managed PostgreSQL (Recommended)

1. Di dashboard Laravel Cloud, buat **Managed PostgreSQL**
2. Copy connection string ke `.env`
3. Laravel Cloud akan auto-configure SSL

### 2.2 Pilihan B: Supabase PostgreSQL

1. Buat project di [Supabase](https://supabase.com)
2. Settings → Database → Connection String (URI)
3. Parse ke format `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=db.xxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-password
```

> Supabase menggunakan PostgreSQL, jadi 100% kompatibel dengan Laravel.

### 2.3 Pilihan C: Neon PostgreSQL (Serverless)

1. Buat project di [Neon](https://neon.tech)
2. Copy connection parameters ke `.env`
3. Neon auto-scales, cocok untuk traffic yang fluktuatif

---

## 3. Migrasi & Seeder

```bash
# Jalankan migrasi
php artisan migrate --force

# Jalankan seeder (HANYA untuk first deploy!)
php artisan db:seed --force

# Jangan jalankan migrate:fresh di production — itu akan hapus semua data!
```

**Seeders yang tersedia:**
- `RoleSeeder` — Membuat role: super_admin, admin_tu, guru, siswa, wali_murid
- `UserSeeder` — Membuat akun default:
  - Super Admin: `admin@sist.test` / `password`
  - Admin TU: `tu@sist.test` / `password`
- `AcademicYearSeeder` — Tahun ajaran default
- `SubjectSeeder` — Mata pelajaran default

---

## 4. Storage Setup

### 4.1 Local Development

```bash
php artisan storage:link
```

File tersimpan di `storage/app/public`

### 4.2 Production dengan S3/Cloud

Tidak perlu `storage:link`. Semua file otomatis di-upload ke cloud storage.

Pastikan bucket permission:
- **Public read** untuk galeri & berita
- **Private** untuk dokumen PPDB (handled by Laravel)

---

## 5. Deploy ke Laravel Cloud

### 5.1 Via Git Push (Git-based Deployment)

```bash
# Tambah remote Laravel Cloud
git remote add laravel-cloud https://cloud.laravel.com/git/your-app.git

# Push ke production
git push laravel-cloud main
```

### 5.2 Build Assets (jika ada Vite/Laravel Mix)

Laravel Cloud biasanya auto-detect dan build assets. Tapi jika perlu manual:

```bash
npm run build
git add public/build
git commit -m "Production build"
git push laravel-cloud main
```

### 5.3 Post-Deploy Commands

Setelah deploy, jalankan di Laravel Cloud console/CLI:

```bash
php artisan migrate --force
php artisan optimize
php artisan filament:upgrade
```

---

## 6. Perintah Terminal Ringkasan

### Local Development

```bash
# Setup awal
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite          # jika pakai SQLite
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

### Production (Laravel Cloud)

```bash
# Setup awal
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate

# Konfigurasi .env dengan DB PostgreSQL + S3
# Lalu:
php artisan migrate --force
php artisan db:seed --force              # HANYA first deploy!
php artisan optimize
php artisan filament:upgrade

# Deploy via git push
```

---

## 7. Checklist Pre-Deploy

- [ ] `.env` sudah diisi dengan konfigurasi production
- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Database PostgreSQL sudah tersedia dan bisa di-connect
- [ ] S3/Cloud storage bucket sudah dibuat dan credentials valid
- [ ] `php artisan migrate --force` berhasil di lokal (test dulu!)
- [ ] Tidak ada `dump()`, `dd()`, atau debug statement di kode
- [ ] Assets sudah di-build (jika pakai Vite)
- [ ] Domain/URL sudah dikonfigurasi di `APP_URL`

---

## 8. Troubleshooting

### Error: `SQLSTATE[08006] could not connect to server`
→ Cek DB_HOST, DB_PORT, dan pastikan firewall/database allow connection dari Laravel Cloud IP

### Error: `Missing S3 credentials`
→ Pastikan `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, dan `AWS_BUCKET` terisi

### Error: `File not found` setelah upload
→ Cek `FILESYSTEM_DISK` dan `MEDIA_DISK` di `.env`. Production harus `s3`, bukan `local`

### Filament tidak muncul setelah deploy
→ Jalankan `php artisan filament:upgrade` dan clear cache

---

## Referensi

- [Laravel Cloud Documentation](https://cloud.laravel.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/11.x/deployment)
- [Spatie Media Library — Working with S3](https://spatie.be/docs/laravel-medialibrary/v11/working-with-media-on-s3)
- [Supabase — Connect to Postgres](https://supabase.com/docs/guides/database/connecting-to-postgres)
