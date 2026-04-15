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


