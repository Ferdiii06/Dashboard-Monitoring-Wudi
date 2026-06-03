# Update Changelog - Laravel Integration

Dokumen ini mencatat seluruh perubahan, pemindahan folder, dan konfigurasi yang dilakukan untuk mengintegrasikan frontend React Dashboard ke dalam backend Laravel.

## Ringkasan Perubahan Utama

1. **Konversi ke Monorepo Laravel + React SPA**:
   - Memindahkan codebase frontend (React + Tailwind CSS) dari struktur standalone ke dalam struktur internal Laravel (`resources/js/` dan `resources/css/`).
   - Menyinkronkan dependensi `package.json` agar berjalan selaras menggunakan Vite dan plugin resmi Laravel Vite.

2. **Migrasi Aset Frontend**:
   - Memindahkan komponen React ke `resources/js/components/`.
   - Memindahkan logika autentikasi ke `resources/js/auth/`.
   - Memindahkan notification overlay ke `resources/js/notification/`.
   - Memindahkan file entri utama `App.jsx` ke `resources/js/App.jsx`.
   - Memindahkan bootstrap script `main.jsx` ke `resources/js/main.jsx`.
   - Memindahkan logo `LogoWudi.png` ke folder `public/LogoWudi.png` agar dapat diakses langsung oleh client web server.
   - Menghapus folder `src/` yang lama untuk menghindari kebingungan struktur.

3. **Integrasi Asset Bundler (Vite + Tailwind CSS v4)**:
   - Memperbarui `vite.config.js` agar menggunakan `@tailwindcss/vite` dan `laravel-vite-plugin` guna menyusun bundle JS/CSS ke dalam folder `public/build/`.
   - Menghapus file konfigurasi terpisah yang usang (`tailwind.config.js`, `postcss.config.js`, `index.html`).
   - Mengonfigurasi `resources/css/app.css` agar memindai file `.jsx` di bawah `resources/js/` menggunakan direktif `@source '../js/**/*.jsx';`.

4. **Konfigurasi Routing & View Laravel**:
   - Membuat file view utama `resources/views/app.blade.php` untuk menampung root element React (`<div id="root"></div>`) dan memuat aset terkompilasi via `@vite`.
   - Mengubah `routes/web.php` agar menggunakan catch-all route (`Route::get('/{any}')`) untuk mengarahkan navigasi web client secara penuh ke React Router.
   - Menyesuaikan route `/login` di `routes/web.php` agar mendeteksi permintaan API (`expectsJson()`) dan mengembalikan respons JSON unauthenticated, sementara permintaan browser biasa akan mengarah ke SPA.

5. **Konfigurasi Database & Environment**:
   - Menyalin berkas `.env.example` dari repositori backend.
   - Mengonfigurasi SQLite database ke berkas yang valid `database/database.sqlite` (menggantikan file `ruvector.db` yang terdeteksi sebagai Redb database, bukan format SQLite).
   - Menjalankan `composer install` (dengan mengabaikan platform requirements eksternal yang hilang di lokal) serta `npm install`.
   - Menjalankan perintah migrasi `php artisan migrate` dan seeding `php artisan db:seed`.
   - Menghasilkan kunci aplikasi (`php artisan key:generate`) dan kunci rahasia JWT (`php artisan jwt:secret`).

6. **Migrasi Penuh ke Laravel Blade Templates (Juni 2026)**:
   - Mengonversi seluruh komponen React (`.jsx`) menjadi berkas tampilan Laravel Blade (`.blade.php`) di bawah `resources/views/`.
   - Membuat layout utama yang reusable pada `resources/views/layouts/app.blade.php` lengkap dengan verifikasi otentikasi token JWT di sisi client (localStorage).
   - Memecah (slicing) sidebar kustom menjadi komponen Blade terpisah di `resources/views/components/sidebar.blade.php` dengan deteksi class navigasi aktif secara dinamis.
   - Membuat berkas halaman Blade untuk:
     - Halaman login (`auth/login.blade.php`) & registrasi (`auth/register.blade.php`) terintegrasi dengan `/api/login` & `/api/register`.
     - Dashboard (`dashboard.blade.php`) terintegrasi dengan `/api/monitoring/dashboard` via polling fetch 10 detik.
     - Analytics (`analytics.blade.php`) memuat visualisasi statistik grafis produktivitas bulanan.
     - Report (`report.blade.php`) untuk Access Control lengkap dengan prompt konfirmasi blokir user.
     - Settings (`settings.blade.php`) untuk pengelolaan data profil admin.
   - Menghapus folder `resources/js/` dan berkas entry point `resources/views/app.blade.php` karena seluruh halaman kini disajikan langsung oleh server Laravel.
   - Menyederhanakan `vite.config.js` untuk kompilasi stylesheet CSS Tailwind saja, meningkatkan kecepatan rendering dan waktu build aplikasi.
   - Menyesuaikan `routes/web.php` untuk melayani rute-rute Blade secara terpisah.

7. **Implementasi Carousel & Google OAuth Integration (Juni 2026)**:
   - **Right Panel Carousel**: Mengimplementasikan slide info statistik interaktif di sisi kanan halaman `login.blade.php` & `register.blade.php` yang berjalan otomatis setiap 6 detik atau secara manual via pagination dots.
   - **Google OAuth Integration (GIS SDK)**: Mengintegrasikan tombol masuk "Continue with Google" menggunakan pustaka resmi `https://accounts.google.com/gsi/client`. Saat pengguna berhasil masuk, data profil didekode client-side dan disinkronkan ke API backend `/api/auth/google`.
   - **Timezone Sync & Headers**: Menyematkan header `X-Timezone` di seluruh request utama ke backend untuk pencatatan zona waktu pengguna secara otomatis.
   - **Dynamic Security Monitor**: Menghubungkan halaman `report.blade.php` dengan API `/api/monitoring/users` dan `/api/monitoring/users/{user}/status` secara dinamis, sehingga status user (active/flagged/banned/warning) dapat dikelola langsung dari panel web admin dengan audit reason log.
   - **Verifikasi OTP (Verify OTP)**: Membuat halaman `verify-otp.blade.php` baru dengan 4 input terpisah, timer hitung mundur kirim ulang, dan alur pendaftaran terintegrasi.
   - **Sidebar Redesign (Mockup Match)**: Mendesain ulang sidebar menggunakan tema visual "WUDI Panel" dengan sudut melengkung premium (`rounded-r-[2.5rem]`), profil admin dinamis (avatar & inisial), pemisahan kategori, efek tooltip hitam pada item biasa saat collapsed, dan popover menu pada item bercabang (Analytics) saat hover dalam keadaan collapsed.
