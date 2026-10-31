# Skensa Jaya - Website Portofolio & LMS SMKN 1 Denpasar

Platform digital resmi SMK Negeri 1 Denpasar (SKENSA) yang memadukan etalase portofolio institusi vokasi unggulan, direktori karya siswa dan konsentrasi keahlian, serta sistem manajemen pembelajaran (LMS).

- Repositori: `https://github.com/Great-YUDZZ/Project-portofolio-sekolah`
- Domain Live: `https://yudzz-app.my.id`
- Semboyan: *"Abhyāsad Dhäryate Vidyä."* (Peliharalah ilmu sampai menjadi tradisi.)

---

## 1. Ikhtisar Proyek

SMK Negeri 1 Denpasar merupakan Sekolah Menengah Kejuruan Pusat Keunggulan (SMK PK) berbasis *Teaching Factory* dan sertifikasi profesi berlisensi LSP-P1 BNSP di Provinsi Bali. Proyek **Skensa Jaya** dibangun untuk menyajikan informasi sekolah secara modern, interaktif, cepat, dan responsif di seluruh perangkat (ponsel, tablet, dan desktop).

Situs ini menerapkan prinsip desain monokrom kontras tinggi yang bersih, tanpa elemen generik, serta mengedepankan performa akses optimal.

---

## 2. Fitur Utama

### A. Portal Publik & Portofolio Institusi
- **Hero Section Layar Penuh (100vh)**: Tampilan visual berlatar gedung sekolah bersejarah dengan tipografi semboyan institusi dan visual siswa vokasi transparan.
- **Sambutan Kepala Sekolah**: Paparan esensial arah dan visi vokasi dari Kepala Sekolah I Wayan Mustika, S.Pd., M.Pd.
- **YouTube Cinema Hub**: Pemutar video resmi dengan daftar putar (playlist) horizontal yang mendukung interaksi roda mouse (mouse wheel) di desktop dan sentuhan halus di perangkat seluler.
- **Infrastruktur & Fasilitas Pembelajaran**: Galeri laboratorium dan bengkel standar industri, mencakup Daikin Center of Excellence (TPTUP), Lab Fiber Optik (TKJ), Studio Gambar BIM (DPIB), Workshop Konstruksi (TKP), Bengkel Otomotif, dan Perpustakaan Digital.
- **Slider 12 Konsentrasi Keahlian**: Carousel interaktif layar penuh mencakup profil, prospek karier, skema sertifikasi LSP-P1 BNSP, dan tautan eksplorasi keahlian.
- **Ekosistem Kemitraan DUDIKA & Jejak Lulusan (BMW)**: Infinite marquee mitra industri resmi (Astra Honda Motor, Toyota Auto2000, PT Telkom Indonesia, PT Daikin, PT PLN, Schneider Electric, dll.) dan statistik penelusuran lulusan bekerja, melanjutkan, dan wirausaha.
- **Etalase Prestasi & Kesiswaan**: Dokumentasi kejuaraan LKS tingkat kota, provinsi, dan nasional, serta kegiatan organisasi kesiswaan (OSIS/MPK, Paskibra, Pramuka, PMR, Seni Budaya).
- **Rilis Berita dengan Interactive Hover Preview**: Tata letak dua kolom interaktif di mana kartu pratinjau di sisi kanan otomatis memperbarui foto, judul, dan kutipan sesuai posisi kursor mouse atau fokus baca pengguna.
- **Pencarian Global Terpadu (`/cari`)**: Mesin pencari instan lintas entitas untuk menemukan jurusan, karya siswa, berita, prestasi, dan staf pengajar.
- **Informasi PPDB / SPMB**: Jalur pendaftaran dan tahapan seleksi peserta didik baru secara komprehensif.

### B. Video Intro Sinematik & Curtain Transition
- Animasi pembuka logo terprogram menggunakan Remotion engine yang dirender menjadi video resolusi tinggi dengan efek split curtain GSAP saat memasuki halaman utama.

### C. Panel Manajemen Konten (CMS Admin) & LMS
- **Multi-Role Authentication**: Pengelolaan akses berbasis peran (Admin, Guru, Siswa) menggunakan middleware RBAC Laravel.
- **Manajemen Konten Portofolio**: Modul pengelolaan artikel berita, pengumuman, agenda kegiatan, galeri foto sarana, portofolio karya siswa, dan data prestasi kejuaraan.
- **Fondasi LMS**: Manajemen data kelas, rombel, pengajar, dan konsentrasi keahlian.

---

## 3. Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.4)
- **Frontend & Styling**: Tailwind CSS 4, Vite
- **Animasi & Interaksi**: GSAP (ScrollTrigger), Lenis Smooth Scroll
- **Automasi Video**: Remotion (React-based video automation)
- **Basis Data**: SQLite / MySQL
- **Web Server & Infrastruktur**: Nginx, Cloudflare Tunnel (HTTPS edge caching)

---

## 4. Struktur Direktori Utama

```text
skensa-jaya/
├── app/
│   ├── Enums/                     # Enum peran pengguna (Admin, Guru, Siswa)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/             # Pengendali dashboard dan CRUD konten
│   │   │   ├── Auth/              # Login, logout, dan otentikasi
│   │   │   ├── Lms/               # Pengendali modul pembelajaran
│   │   │   └── Public/            # Pengendali rute publik portofolio
│   │   └── Middleware/            # Pengaman akses EnsureRole
│   └── Models/                    # Model Eloquent (Major, Post, Work, Achievement, dll.)
├── database/
│   ├── migrations/                # Skema basis data
│   └── seeders/                   # Seeder data resmi 9 bidang, 12 jurusan, dan konten
├── public/                        # Aset publik statis, media video, dan gambar
├── remotion/                      # Sumber video intro animasi komputasi
├── resources/
│   ├── css/                       # Gaya dasar dan variabel tema Tailwind CSS
│   ├── js/                        # Modul interaktif (intro, lenis, search modal)
│   └── views/
│       ├── layouts/               # Layout umum (public.blade.php, admin, auth)
│       └── public/                # Tampilan halaman publik (home, major, gallery, dll.)
└── routes/
    └── web.php                    # Deklarasi rute aplikasi
```

---

## 5. Panduan Instalasi Lokal

### Prasyarat
- PHP 8.2 atau lebih baru (disarankan PHP 8.4)
- Composer
- Node.js 20 atau lebih baru dan NPM
- Ekstensi PHP: `pdo_sqlite` atau `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`

### Langkah-Langkah

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/Great-YUDZZ/Project-portofolio-sekolah.git
   cd Project-portofolio-sekolah
   ```

2. **Instal Dependensi PHP**:
   ```bash
   composer install
   ```

3. **Instal Dependensi Node.js**:
   ```bash
   npm install
   ```

4. **Konfigurasi Berkas Lingkungan**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrasi dan Pengisian Data Awal**:
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

6. **Kompilasi Aset Frontend**:
   ```bash
   npm run build
   ```

7. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Akses aplikasi pada peramban melalui alamat `http://127.0.0.1:8000`.

---

## 6. Pengujian Otomatis

Proyek dilengkapi dengan pengujian unit dan integrasi untuk memastikan reliabilitas alur autentikasi, navigasi publik, dan performa respon.

Untuk menjalankan seluruh rangkaian pengujian:
```bash
php artisan test
```

---

## 7. Lisensi

Proyek ini dikembangkan untuk kebutuhan portofolio dan modernisasi sistem informasi SMK Negeri 1 Denpasar. Lisensi kode sumber terbuka di bawah [MIT License](LICENSE).
