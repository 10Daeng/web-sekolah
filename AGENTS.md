# AGENTS.md — Sistem Informasi Sekolah Terpadu (SIST)

## Project Overview
SIST adalah platform web berbasis Laravel 11 + Filament v3 + Tailwind CSS untuk manajemen sekolah terpadu: publik, PPDB, dan akademik.

## Tech Stack
- **Backend:** Laravel 11 (PHP ^8.2)
- **Admin Panel:** Filament v3 + custom Blade pages
- **Frontend:** Blade + Tailwind CSS + Alpine.js
- **Database:** PostgreSQL (production) / SQLite (local dev)
- **Auth:** Laravel Fortify + Spatie Permission (multi-role)
- **File Upload:** Spatie Media Library (local/S3)
- **Export:** Maatwebsite Excel
- **Deployment Target:** [Laravel Cloud](https://cloud.laravel.com/)

## Architecture
- **Filament Resources:** Users, Students, Teachers, Classes, Subjects, AcademicYears, Schedules, Posts, Albums, Registrations (PPDB), Documents, Achievements, AcademicCalendars
- **Blade Custom:** Frontend publik (7 halaman), Settings sekolah, Audit logs
- **Frontend Controllers:** Home, Berita, Galeri, Kalender, Profil, PPDB
- **Multi-Role:** super_admin, admin_tu, guru, siswa, wali_murid

## Key Config Files
- `config/sekolah.php` — Identitas sekolah terpusat (override via DB settings)
- `config/app.php` — `app.sekolah` merged dari `config/sekolah.php`
- `.env` — Database PostgreSQL/SQLite, S3 storage, session/cache driver

## Database
### Local Development
```bash
DB_CONNECTION=sqlite
```
Run: `touch database/database.sqlite && php artisan migrate:fresh --seed`

### Production (Laravel Cloud)
```bash
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=sist
DB_USERNAME=your-user
DB_PASSWORD=your-password
```
Run: `php artisan migrate --force && php artisan db:seed --force`

### Storage
- **Local dev:** `FILESYSTEM_DISK=public`, `MEDIA_DISK=public`
- **Production:** `FILESYSTEM_DISK=s3`, `MEDIA_DISK=s3`

## Default Accounts (after seeding)
- Super Admin: `admin@sist.test` / `password`
- Admin TU: `tu@sist.test` / `password`

## Common Commands
```bash
# Local setup
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve

# Production deploy
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan db:seed --force    # first deploy only
php artisan optimize
php artisan filament:upgrade
```

## Important Notes
- **Never run** `migrate:fresh` on production — it drops all tables!
- Filament routes are auto-discovered from `app/Filament/Resources`
- Frontend views use dynamic data from DB with dummy fallbacks
- PPDB uploads use Spatie Media Library (7 collections: kk, akta, ijazah, foto, sertifikat, sktm, surat_pindah)
- Settings table (`settings`) overrides `config/sekolah.php` values at boot time
