# Deskripsi Repository Aplikasi Booking Camp dan Waterboom

Repository ini berisi aplikasi **Booking Camp dan Waterboom** yang dibangun menggunakan teknologi **Laravel**, **MySQL**, dan **Bootstrap**. Aplikasi ini bertujuan untuk memudahkan pengguna dalam melakukan pemesanan tempat perkemahan dan waterboom secara online, dengan antarmuka yang responsif dan mudah digunakan.

## Fitur Utama 🌟

- **Pendaftaran dan Login Pengguna**: Pengguna dapat mendaftar dan masuk untuk mengelola pemesanan mereka.
- **Pencarian dan Pemesanan Tempat**: Memungkinkan pengguna untuk mencari tempat perkemahan atau waterboom, melihat ketersediaan, dan melakukan pemesanan.
- **Manajemen Pemesanan**: Admin dapat mengelola pemesanan, termasuk konfirmasi dan pembatalan.
- **Laporan dan Statistik**: Menyediakan laporan pemesanan dan statistik untuk analisis bisnis.

## Teknologi yang Digunakan 🛠️

- **Laravel**: Framework PHP untuk membangun aplikasi web dengan arsitektur MVC.
- **MySQL**: Basis data relasional yang digunakan untuk menyimpan data aplikasi.
- **Bootstrap**: Framework CSS untuk membangun antarmuka pengguna yang responsif.

## Panduan Menjalankan Program 🚀

1. **Clone Repository**
   
   ```
   git clone https://github.com/abdasis/BookingApp.git
   ```
2. **Masuk ke Direktori Proyek**
   
   ```
   cd BookingApp
   ```
3. **Install Dependencies**
   
   ```
   composer install
   npm install
   npm run dev
   ```
4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi basis data serta parameter lainnya.
   
   ```
   cp .env.example .env
   ```
5. **Generate Application Key**
   
   ```
   php artisan key:generate
   ```
6. **Migrasi dan Seed Database**
   
   ```
   php artisan migrate --seed
   ```
7. **Menjalankan Server**
   
   ```
   php artisan serve
   ```
8. **Akses Aplikasi**
   Buka browser dan akses `http://localhost:8000` untuk melihat aplikasi.

## Lisensi 📜

Aplikasi ini dilisensikan di bawah **MIT License**. Silakan merujuk ke file `LICENSE` untuk informasi lebih lanjut.

---

Ini adalah proyek open-source. Kamu bebas untuk berkontribusi, mengubah, dan mendistribusikan aplikasi ini sesuai dengan ketentuan lisensi MIT. Selamat berkontribusi! 🎉
