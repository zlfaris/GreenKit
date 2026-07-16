# GreenKit: E-Commerce Platform for Sustainable Lifestyle

![Framework](https://img.shields.io/badge/FRAMEWORK-Laravel%20%7C%20PHP-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Styling](https://img.shields.io/badge/STYLING-Tailwind%20CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Frontend](https://img.shields.io/badge/FRONTEND-Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![Database](https://img.shields.io/badge/DATABASE-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![QA Testing](https://img.shields.io/badge/QA%20TESTING-Testsprite%20Automated-orange?style=for-the-badge)

## 📌 Latar Belakang & Filosofi

**GreenKit** berawal dari kepedulian sederhana terhadap meningkatnya penggunaan produk sekali pakai yang berdampak besar pada kelestarian lingkungan. Kami percaya bahwa setiap orang mampu memberikan kontribusi positif bagi bumi melalui pilihan-pilihan kecil yang praktis dan mudah diterapkan dalam kehidupan sehari-hari.

Kami menghadirkan platform digital **GreenKit** untuk menyediakan rangkaian produk *reusable* berkualitas tinggi yang dirancang khusus untuk menemani aktivitas harian masyarakat, sekaligus menekan konsumsi plastik sekali pakai yang terus menumpuk di ekosistem kita.

Platform ini dapat diakses secara langsung melalui: **[https://greenkitofficial.my.id](https://greenkitofficial.my.id)**

---

## 🎯 Visi Kami Untuk Bumi yang Lebih Baik

1. **Mendorong Gaya Hidup Ramah Lingkungan:** Membantu masyarakat beralih dari kebiasaan menggunakan plastik sekali pakai menuju kebiasaan yang lebih berkelanjutan dengan alternatif produk yang aman dan mudah digunakan.
2. **Mengurangi Jejak Plastik di Indonesia:** Berkomitmen secara aktif meminimalisasi jumlah sampah plastik yang mencemari lingkungan tanah, laut, dan makhluk hidup di sekitarnya melalui budaya penggunaan kembali (*reusable*).
3. **Mempermudah Akses Solusi Sustainable:** Menjadikan produk ramah lingkungan lebih terjangkau, mudah ditemukan, dan dapat diakses oleh siapa saja tanpa hambatan operasional.

---

## ✨ Arsitektur & Fitur Aplikasi (User Journey)

Aplikasi e-commerce terintegrasi ini dibangun menggunakan arsitektur Laravel yang kokoh dengan fokus pada kenyamanan pelanggan dalam mengadopsi produk berkelanjutan:

### 🔒 Autentikasi Pengguna & Keamanan
- **Secure Authentication Access:** Sistem masuk log (*login*) yang memanfaatkan fitur autentikasi bawaan Laravel yang aman untuk melindungi integritas data akun pelanggan.
- **CSRF & Access Protection:** Implementasi *Middleware* pengaman rute bawaan Laravel guna mencegah eror otorisasi (*403 Forbidden*) serta serangan CSRF (*419 Page Expired*).

### 🛍️ Katalog Produk & Detail Spesifikasi
- **Interactive Product Catalog Display:** Etalase interaktif yang memuat visualisasi produk ramah lingkungan secara utuh tanpa kendala *broken layout*.
- **Comprehensive Specification Validation:** Halaman detail produk yang menyajikan informasi harga, sisa stok, varian produk, serta deskripsi material secara transparan melalui integrasi Blade dan Alpine.js.

### 🛒 Manajemen Keranjang & Alur Checkout
- **Real-Time Cart Calculation:** Fitur penambahan item, modifikasi kuantitas belanja, dan penghapusan produk dengan kalkulasi subtotal instan secara reaktif memanfaatkan kapabilitas Alpine.js tanpa memuat ulang halaman (*no full page reload*).
- **Integrated Shipping Form:** Formulir pengiriman data logistik yang efisien untuk akurasi alamat pelanggan sebelum dialihkan ke gerbang pembayaran.

### 📊 Manajemen Pesanan & Dashboard Pelanggan (Fitur Baru)
- **Real-Time Order Status Tracking:** Integrasi komponen *visual stepper progress* interaktif pada panel *Active Orders* pelanggan untuk memantau tahapan proses pesanan secara berkala (Validasi Pembayaran, Pesanan Diproses, Sedang Dikirim, hingga Tiba di Tujuan).
- **Comprehensive Order History Management:** Halaman riwayat transaksi belanja yang mendokumentasikan log pesanan selesai (*Completed Orders*), lengkap dengan kartu ringkasan item, visual *thumbnail* produk, akumulasi biaya, status tanda terima, dan kontrol manajemen arsip data.

### 👑 Dashboard Administrasi (Admin & Backoffice Panel)
- **Dashboard Overview & Sales Analytics:** Panel kendali utama yang menyajikan metrik performa toko secara *real-time*, mencakup akumulasi total pendapatan (*Total Revenue*), jumlah pesanan aktif (*Active Orders*), pengingat stok menipis (*Low Stock Alerts*), serta grafik analisis penjualan interaktif (*Sales Analytics Graph*) berbasis filter periodik (Harian, Mingguan, Bulanan, Tahunan).
- **Centralized Order Management:** Sistem pengelolaan transaksi pelanggan yang dilengkapi fitur pencarian berdasarkan ID Pesanan (*Order ID*), penyaringan status logistik, pemantauan status validasi pembayaran (Awaiting Validation / Paid), dan kontrol eksekusi pemrosesan pesanan.
- **Dynamic Product Inventory Management:** Kendali manajemen produk berbasis operasi CRUD (*Create, Read, Update, Delete*) penuh, memungkinkan admin menambahkan varian produk baru, memanipulasi label harga, mengorganisasikan aset gambar, serta memperbarui kuantitas indikator stok secara langsung.
  
---

## 🛠️ Spesifikasi Teknologi

- **Backend Platform:** Laravel Framework (PHP)
- **Frontend Engine:** Tailwind CSS & Alpine.js
- **Database Architecture:** MySQL Management System
- **Quality Assurance Testing:** Automated E2E & Visual Testing via Testsprite Tool
- **Server Deployment:** cPanel Environment with LiteSpeed Web Server and Symlink Storage

---

## 🚨 Penjaminan Mutu (Quality Assurance)

Untuk memastikan keandalan sistem dalam melayani transaksi produk berkelanjutan secara massal, seluruh komponen antarmuka pengguna (*User View*) telah diaudit dan diuji secara berkala menggunakan framework otomatisasi berbasis AI untuk mendeteksi:
- Galat kode status HTTP (403 Forbidden, 419 Page Expired, 500 Internal Server Error).
- Kerusakan visual tata letak aset (*broken layout/CSS bug*).
- Kegagalan pemuatan berkas visual gambar (*broken image asset*).

---

> © 2026 GreenKit Development Team. Menciptakan bumi yang lebih bersih dan sehat.
