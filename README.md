# CRUD Mahasiswa (PHP + PDO)

## Persyaratan
- PHP 8.x
- MySQL / MariaDB
- PDO extension (biasanya sudah ada)

## Setup
1. Import schema.sql ke MySQL:
   - phpMyAdmin / MySQL CLI / Workbench
2. Sesuaikan kredensial database di config.php.
3. Jalankan server:
   - php -S localhost:8000 -t public
4. Buka: http://localhost:8000

## Struktur
- config.php
- schema.sql
- src/ (Database, Model, Repository)
- public/ (file frontend minimal)
- uploads/ (otomatis dibuat saat upload)

## Catatan
- File upload dibatasi 2MB, hanya JPG/PNG.
- Gunakan prepared statements lewat PDO untuk mencegah SQL injection.
-
