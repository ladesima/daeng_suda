# DAENG SUDA – Laravel SDA (Admin & User)

Dua tampilan: **Admin** untuk input/manajemen data; **User** (public) untuk menampilkan data.
Fitur contoh: Sektor SDA, Potensi, Berita/Informasi, Metrik rekap (kecamatan, desa/kelurahan, sektor).

> Framework target: **Laravel 11 + PHP 8.2+ + MySQL**. Tailwind via Breeze.

## 1) Buat project Laravel baru
```bash
# pastikan php, composer, npm terpasang
composer create-project laravel/laravel daeng-suda
cd daeng-suda
```

## 2) Salin skeleton ini
Unzip isi repo zip ini ke folder proyek Laravel kamu (overwrite jika diminta).
File yang ditambahkan/diubah ada di: `app/Models`, `app/Http/Controllers`, `app/Http/Middleware`,
`database/migrations`, `database/seeders`, `resources/views`, `routes/web.php`, dan `.env.example` tambahan.

## 3) Instal auth (Breeze)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

## 4) Konfigurasi .env
Atur koneksi DB dan mail jika perlu. Lihat `.env.example` yang disertakan untuk variabel tambahan.
```bash
cp .env .env.local
php artisan key:generate
```

## 5) Migrasi & seeder
```bash
php artisan migrate --seed
```
Seeder akan membuat user admin:
- Email: `admin@example.com`
- Password: `password` (ubah setelah login)

## 6) Jalankan
```bash
php artisan serve
```

- Halaman user (public): `http://localhost:8000/`
- Login admin: `http://localhost:8000/login`
- Admin dashboard: `http://localhost:8000/admin`

## Struktur Data
- **Sector** (nama, ikon, deskripsi ringkas)
- **Potential** (milik sector, nama, nilai/angka, satuan, keterangan)
- **News** (judul, ringkas, isi, kategori, tanggal)
- **Metric** (rekap angka: kecamatan, desa, sektor)
- **User** punya kolom `role` = `admin` atau `user`

## Catatan
Ini skeleton minimal; kembangkan sesuai kebutuhan (upload gambar, role lebih detail, peta, dsb).
```

# daeng_suda
