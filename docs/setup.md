# Setup Project Klinik Harapan Ibu
Dokumentasi ini digunakan untuk menjalankan project secara lokal dengan konfigurasi manual.

## 1. Install Requirement
- PHP >= 8.2
- Composer
- PostgreSQL
- Node.js

## 2. Clone Repository
git clone https://gitlab.com/ginaindriani/klinik_harapan_ibu.git

## 3. Masuk Folder
cd klinik_harapan_ibu

## 4. Install Dependency
composer install

## 5. Copy ENV
cp .env.example .env

## 6. Generate Key
php artisan key:generate

## 7. Setup Database
- buat database di PostgreSQL
- sesuaikan di file .env

## 8. Jalankan Project
php artisan serve

## Catatan
- File `.env.example` sudah disediakan di root project.
- Dependency backend dikonfigurasi untuk PHP `8.2+`.


