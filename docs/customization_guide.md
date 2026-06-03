# Panduan Kustomisasi Struktur Dashboard (Laravel Blade)

Dokumen ini berisi informasi mengenai komponen, file, dan folder apa saja yang boleh dimodifikasi, ditambah, atau diganti tanpa merusak arsitektur integrasi Laravel Blade yang telah dibangun.

---

## 🟢 Bagian yang BOLEH Dirombak / Diganti

### 1. File Tampilan Blade (`resources/views/`)
- Anda bebas mengubah tampilan, tata letak, warna, teks, dan animasi di dalam seluruh file Blade (seperti `dashboard.blade.php`, `analytics.blade.php`, `report.blade.php`, `settings.blade.php`).
- Anda boleh memodifikasi sidebar terpisah pada `resources/views/components/sidebar.blade.php` atau layout utama pada `resources/views/layouts/app.blade.php`.
- Jika ingin membuat halaman baru, cukup buat file `.blade.php` baru di dalam folder tersebut dan daftarkan rutenya di `routes/web.php`.

### 2. Styling (CSS) & Utility Class
- Proyek ini menggunakan Tailwind CSS v4. Anda dapat menggunakan kelas-kelas utilitas Tailwind secara langsung di dalam kode Blade Anda.
- Jika ingin memodifikasi variabel tema global (seperti font, warna kustom, dll.), Anda dapat mengubah blok `@theme` di dalam file `resources/css/app.css`.

### 3. Konfigurasi API Target (`.env`)
- Aplikasi ini terhubung ke backend secara dinamis menggunakan variabel `API_URL` di dalam file `.env`.
- Secara default, aplikasi akan menembak API backend Cloud Run yang sudah terdeploy di:
  `https://laravel-app-437363373527.asia-southeast2.run.app/api`
- Jika Anda ingin mengarahkan frontend ke server API lokal Anda, cukup ubah nilai `API_URL` di `.env` menjadi:
  `API_URL=/api` atau `API_URL=http://127.0.0.1:8000/api`

### 4. Database Seeders & Migrations (`database/`)
- Anda dapat membuat migrasi baru untuk memodifikasi skema tabel SQLite (`database/database.sqlite`).
- Seeders di `database/seeders/DatabaseSeeder.php` dapat diubah untuk menghasilkan data monitoring dummy yang lebih bervariasi.

---

## 🔴 Bagian yang TIDAK BOLEH Diubah / Dihapus Sembarangan

### 1. File Konfigurasi Integrasi Bundler (`vite.config.js` & `package.json`)
- **`vite.config.js`**: Jangan mengubah plugin atau konfigurasi input paths (`resources/css/app.css`) karena ini digunakan untuk menyusun stylesheet Tailwind CSS v4.
- **`package.json`**: Jangan menghapus package `@tailwindcss/vite` dan `laravel-vite-plugin` karena dependensi ini mengikat compiler Tailwind CSS v4 ke Laravel.

### 2. Pengecekan Otentikasi Client-Side di Layout Utama (`layouts/app.blade.php`)
- Script pengecekan `localStorage.getItem('auth_token')` di bagian `<head>` sangat penting. Jangan menghapus script ini agar halaman dashboard tidak dapat diakses langsung oleh tamu (guest) tanpa login.

---

## 🚀 Panduan Menjalankan Aplikasi di Lokal

Untuk menjalankan aplikasi secara lokal dalam mode pengembangan, buka terminal Anda dan jalankan perintah berikut:

### Langkah 1: Jalankan Web Server Laravel
```bash
php artisan serve
```
Aplikasi web frontend dapat diakses secara default di [http://127.0.0.1:8000](http://127.0.0.1:8000).

### Langkah 2: Menjalankan Kompilasi Aset Visual
Jika Anda melakukan perubahan pada file CSS atau ingin memperbarui Tailwind bundle, Anda dapat memantau perubahannya secara real-time dengan:
```bash
npm run dev
```

### Langkah untuk Produksi (Build Akhir)
Sebelum melakukan deployment, jalankan perintah berikut untuk mengompilasi aset CSS secara optimal:
```bash
npm run build
```
Aset yang terkompilasi akan diletakkan di dalam folder `public/build/` secara otomatis.
