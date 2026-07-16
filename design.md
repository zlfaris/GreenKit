# GreenKit Design System & Coding Guidelines

Dokumen ini adalah panduan arsitektur antarmuka (UI) dan standar penulisan kode untuk aplikasi e-commerce GreenKit. Seluruh pengembangan harus mematuhi prinsip Clean Code, Modularitas, dan Maintainability.

## 1. Brand Identity & Design Tokens

### 1.1. Color Palette (Tailwind Configuration)
Gunakan kode warna kustom ini di dalam `tailwind.config.js`:
- **Primary (Dark Green):** `#445344` (Digunakan untuk Navbar, Footer, Button Utama, dan Card Overlay).
- **Primary Hover:** `#364236` (State saat button di-hover).
- **Background (Light):** `#FFFFFF` (Putih murni untuk background section/card) dan `#F9FAFB` (Tailwind `gray-50` untuk background body agar kontras dengan card).
- **Text Main:** `#1F2937` (Tailwind `gray-800` untuk teks paragraf/body).
- **Text Muted:** `#6B7280` (Tailwind `gray-500` untuk teks placeholder, sub-judul).
- **Border:** `#E5E7EB` (Tailwind `gray-200` untuk garis pembatas dan input form).

### 1.2. Typography
- **Font Family:** `Inter` atau `Poppins` (Sans-serif).
- **Headings (H1-H3):** Font-bold, warna Primary atau Text Main.
- **Body Text:** Text-sm atau text-base, reguler, warna Text Main.

---

## 2. UI Component Library (Blade Components)
Untuk menjaga prinsip **DRY (Don't Repeat Yourself)** dan kemudahan *refactoring*, elemen UI yang berulang WAJIB dibuat menjadi Laravel Blade Components (`resources/views/components/`).

### 2.1. Buttons (`<x-button>`)
- **Primary Button (Solid):**
  `bg-[#445344] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#364236] transition-colors duration-200 w-full text-center`
- **Icon Button (Add to Cart '+' di Shop):**
  `bg-white text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow-md border border-gray-100 hover:bg-gray-50 transition-colors`

### 2.2. Form Inputs (`<x-input>`)
- **Text/Email/Password Input:**
  `w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#445344]/50 focus:border-[#445344] outline-none transition-all text-sm`
- **Labels:**
  `block text-sm font-medium text-gray-700 mb-1.5`

### 2.3. Product Cards (`<x-product-card>`)
- **Container:** `bg-[#445344] rounded-xl overflow-hidden shadow-sm flex flex-col`
- **Image Wrapper:** `bg-gray-100 w-full aspect-square relative` (Gunakan background terang/abu-abu muda untuk gambar produk agar kontras).
- **Content Area:** `p-4 text-white flex flex-col gap-1` (Judul produk font-semibold text-sm, Harga text-sm, Bintang rating kuning).

### 2.4. Layouts & Spacing
- **Container / Wrapper:** Gunakan `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8` untuk menahan lebar konten agar tidak terlalu melebar di layar besar.
- **Section Spacing:** Gunakan `py-16` atau `py-24` untuk jarak vertikal antar section utama.

---

## 3. Coding Standards & Clean Code Principles

### 3.1. Separation of Concerns (Pemisahan Logika)
- **View (Blade):** HANYA untuk menampilkan UI. Dilarang melakukan *query* database (`Product::all()`) di dalam Blade.
- **Controller:** Mengambil data dari Model, memproses logika bisnis, dan mem-passing variabel ke Blade.
- **Komponen UI:** Jika ada blok kode HTML yang panjangnya lebih dari 20 baris dan digunakan di lebih dari satu halaman (misal: Navbar, Footer, Product Card), WAJIB diekstrak menjadi file komponen terpisah (contoh: `resources/views/components/navbar.blade.php`).

### 3.2. Semantic HTML
Gunakan tag HTML5 yang sesuai maknanya untuk alasan SEO dan Aksesibilitas (Accessibility):
- Gunakan `<header>` untuk Navbar.
- Gunakan `<footer>` untuk Footer.
- Gunakan `<main>` untuk pembungkus konten utama.
- Gunakan `<section>` untuk bagian-bagian halaman (seperti 'Top Selling', 'Customer Review').
- Gunakan `<article>` untuk card produk.

### 3.3. Penamaan (Naming Conventions)
- **URL/Routes:** Kebab-case (contoh: `/detail-product`, `/checkout`).
- **File Views:** Kebab-case (contoh: `detail-product.blade.php`).
- **Variabel Controller:** CamelCase atau snake_case secara konsisten (contoh: `$topSellingProducts`).

### 3.4. Maintainability & Refactoring
- **Hindari Hardcode CSS:** Jangan menulis *inline style* (`style="color: red;"`). Selalu gunakan utility class dari Tailwind.
- **Image Assets:** Simpan gambar di `public/images/`. Saat dipanggil di Blade, selalu sertakan atribut `alt="Deskripsi Gambar"` untuk SEO.
- **Responsiveness:** Terapkan prinsip *Mobile-First Design*. Gunakan prefix `md:` dan `lg:` untuk menyesuaikan layout di layar desktop. Desain yang diberikan adalah desktop, pastikan saat di layar HP, grid menjadi 1 kolom (`grid-cols-1 md:grid-cols-3`).