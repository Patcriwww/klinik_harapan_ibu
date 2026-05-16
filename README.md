# Klinik Harapan Ibu

## Deskripsi
Project ini merupakan aplikasi sistem informasi manajemen klinik berbasis web untuk membantu pengelolaan data pasien, dokter, jadwal, dan layanan klinik.

## Anggota Tim
- Gina Indriani (0112523016) - Backend Developer
- Fasya Nindya Amaliansyah (0112523015) - UI/UX Designer
- Julia Ardhana (0112523019) - Scrum Master
- Dita Putri Khairunisa (0112523012) - Product Owner
- Bona Firmanto (0112523009) - Bussines Analyst & Documentation
- Adrian Hardinata (0112523049) - Frontend Developer
- Fachri Reyhan (0112523013) - Frontend Developer

## Tech Stack
- Backend: PHP (Laravel)
- Database: PostgreSQL / MySQL
- Frontend: Bootstrap, CSS, HTML, JS
- Version Control: Git & GitLab
- CI/CD: GitLab CI/CD


# Setup Project Klinik Harapan Ibu
Dokumentasi ini digunakan untuk menjalankan project secara lokal dengan konfigurasi manual.

## 1. Install Requirement
- PHP >= 8.2
- Composer
- PostgreSQL

## 2. Clone Repository
git clone https://gitlab.com/ginaindriani/klinik_harapan_ibu.git

## 3. Masuk Folder
cd klinik_harapan_ibu

## 4. Install Dependency
composer install

## 5. Copy ENV
cp .env.example .env
Konfigurasi Database PostgreSQL
Lalu ubah file .env menjadi seperti berikut:
- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=klinik_harapan_ibu
- DB_USERNAME=postgres (sesusikan dengan usernamene)
- DB_PASSWORD=password (sesusikan dengan password saat setup postgres)

## 6. Generate Key
php artisan key:generate

## 7. Setup Database
- buat database di PostgreSQL
- sesuaikan di file .env

## 8. Jalankan Project
php artisan serve

## Catatan
- File `.env.example` tersedia di root project.
- Project dikonfigurasi untuk berjalan di PHP `8.2+` dengan `spatie/laravel-permission` seri `6.x`.

## Deploy ke Render
Project ini sudah disiapkan untuk deploy Docker di Render.

1. Pastikan service memakai `render.yaml` atau isi environment variables berikut di Render:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://domain-kamu.onrender.com`
- `APP_KEY=<app-key-laravel>`
- `DB_CONNECTION=pgsql`
- `DB_HOST=<host-postgres-render>`
- `DB_PORT=5432`
- `DB_DATABASE=<nama-db>`
- `DB_USERNAME=<username-db>`
- `DB_PASSWORD=<password-db>`
- `SESSION_DRIVER=file`
- `SESSION_SECURE_COOKIE=true`
- `SESSION_SAME_SITE=lax`

2. Saat container start, file [tools/render-start.sh](D:/Mata%20Kuliah/SEMESTER%206/PPL/klinik_harapan_ibu/tools/render-start.sh:1) akan:
- menyiapkan folder `storage` dan `bootstrap/cache`
- menjalankan `php artisan storage:link`
- menjalankan `php artisan migrate --force`
- menjalankan `php artisan db:seed --force`

3. Health check Render bisa diarahkan ke `/up`.


# klinik_harapan_ibu
# klinik_harapan_ibu
"# klinik_harapan_ibu" 
