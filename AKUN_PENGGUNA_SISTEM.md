# Daftar Kredensial Akun Sistem SMKN 1 Denpasar (Terenkripsi di Database & Tersimpan Khusus di Vault Lokal)

Dokumen ini memuat daftar akun resmi yang terkonfigurasi pada pangkalan data untuk operasional Panel Terpadu SMKN 1 Denpasar (`/login`). Seluruh kata sandi telah dirotasi pada tanggal 2026-11-02 pasca-audit keamanan dan berkas ini dihapus dari repositori publik GitHub.

---

## 1. Akun Administrator (Wewenang Penuh)

- **Identitas**: Administrator Skensa
- **Username**: `admin`
- **Email**: `admin@skensa.sch.id`
- **Kata Sandi**: `Skensa#Admin!2026_R9x`
- **Peran**: `admin`
- **Autentikasi Dua Faktor (2FA)**: Wajib aktif. Saat login pertama kali, sistem akan menyajikan Kode QR untuk dipindai menggunakan Google Authenticator atau Aegis pada smartphone. Setelah aktif, halaman `/two-factor/setup` dikunci secara otomatis.
- **Wewenang**:
  - CRUD penuh pada Berita dan Pengumuman seluruh sekolah dan jurusan.
  - CRUD penuh pada Tenaga Pendidik dan Staf.
  - CRUD penuh pada Album dan Foto Galeri.
  - Manajemen akun pengguna (mengaktifkan/menonaktifkan akun, membuat akun guru).
  - Meninjau, menyetujui, atau menolak draf berita kiriman siswa dari seluruh jurusan.
  - Mengakses halaman Pemantau Beban Server (`/admin/server`) untuk memantau CPU, RAM, Disk, Uptime, Daemon, dan Top 10 Proses.
  - Melihat rekaman Jejak Audit Keamanan (`/admin/audit`).

---

## 2. Akun Guru Produktif Jurusan

Guru memiliki wewenang mengelola konten jurusannya masing-masing, memoderasi draf berita kiriman siswa jurusannya, dan mengaktifkan akun siswa baru di jurusannya.

### A. Guru Rekayasa Perangkat Lunak (RPL)
- **Nama**: I Wayan Artha, S.Kom., M.Cs.
- **Username**: `guru_rpl`
- **Email**: `artha@skensa.sch.id`
- **Kata Sandi**: `Skensa#GuruRPL!2026_K4m`
- **Peran**: `guru`
- **Kejuruan**: Rekayasa Perangkat Lunak

### B. Guru Teknik Komputer dan Jaringan (TKJ)
- **Nama**: Ni Made Sukerti, S.Kom.
- **Username**: `guru_tkj`
- **Email**: `sukerti@skensa.sch.id`
- **Kata Sandi**: `Skensa#GuruTKJ!2026_P7v`
- **Peran**: `guru`
- **Kejuruan**: Teknik Komputer dan Jaringan

### C. Guru Desain Komunikasi Visual (DKV)
- **Nama**: I Made Suardana, S.Sn.
- **Username**: `guru_dkv`
- **Email**: `suardana@skensa.sch.id`
- **Kata Sandi**: `Skensa#GuruDKV!2026_W2q`
- **Peran**: `guru`
- **Kejuruan**: Desain Komunikasi Visual

---

## 3. Akun Siswa (Pengirim Berita Sekolah)

Siswa melakukan pendaftaran mandiri atau menggunakan akun berikut. Siswa hanya dapat membuat konten kategori Berita (tidak diizinkan membuat Pengumuman maupun mengunggah file video langsung). Setiap berita yang dibuat siswa otomatis berstatus `pending` dan memerlukan persetujuan Guru Jurusan atau Admin sebelum tayang di portal publik.

### A. Siswa RPL
- **Nama**: Gede Rama Wijaya
- **Username / NIS**: `22001`
- **Email**: `rama.22001@siswa.skensa.sch.id`
- **Kata Sandi**: `Skensa#Siswa22001!_N8b`
- **Peran**: `siswa`
- **Kejuruan**: Rekayasa Perangkat Lunak
- **Status Akun**: Aktif (`active`)

### B. Siswa TKJ
- **Nama**: Kadek Ayu Maharani
- **Username / NIS**: `22002`
- **Email**: `ayu.22002@siswa.skensa.sch.id`
- **Kata Sandi**: `Skensa#Siswa22002!_T5j`
- **Peran**: `siswa`
- **Kejuruan**: Teknik Komputer dan Jaringan
- **Status Akun**: Aktif (`active`)

### C. Siswa DKV
- **Nama**: Komang Bayu Nugraha
- **Username / NIS**: `22003`
- **Email**: `bayu.22003@siswa.skensa.sch.id`
- **Kata Sandi**: `Skensa#Siswa22003!_H3z`
- **Peran**: `siswa`
- **Kejuruan**: Desain Komunikasi Visual
- **Status Akun**: Aktif (`active`)

---

## 4. Alamat Akses Halaman Terkait

- **Halaman Masuk (Login)**: `/login`
- **Halaman Pendaftaran Siswa**: `/daftar`
- **Halaman Panel Terpadu**: `/admin`
- **Halaman Verifikasi 2FA**: `/two-factor/challenge`
- **Halaman Konfigurasi 2FA**: `/two-factor/setup`
