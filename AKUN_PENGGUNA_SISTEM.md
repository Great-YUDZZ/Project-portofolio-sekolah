# Daftar Kredensial Akun Siap Pakai Sistem SMKN 1 Denpasar

Dokumen ini memuat daftar akun terkonfigurasi pada pangkalan data untuk pengujian dan operasional Panel Terpadu SMKN 1 Denpasar (`/login`).

---

## 1. Akun Administrator (Wewenang Penuh)

- **Identitas**: Administrator Skensa
- **Username**: `admin`
- **Kata Sandi**: `admin123`
- **Peran**: `admin`
- **Autentikasi Dua Faktor (2FA)**: Wajib aktif. Saat login pertama kali, sistem akan menyajikan Kode QR untuk dipindai menggunakan Google Authenticator atau Aegis pada smartphone.
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
- **Nama**: I Made Arisandi, S.Kom.
- **Username / NIP**: `guru_rpl` (atau NIP: `198501152010011002`)
- **Kata Sandi**: `guru123`
- **Peran**: `guru`
- **Kejuruan**: Rekayasa Perangkat Lunak (ID Jurusan: 11)

### B. Guru Teknik Komputer dan Jaringan (TKJ)
- **Nama**: I Ketut Widana, S.T.
- **Username / NIP**: `guru_tkj` (atau NIP: `198203202008011005`)
- **Kata Sandi**: `guru123`
- **Peran**: `guru`
- **Kejuruan**: Teknik Komputer dan Jaringan (ID Jurusan: 10)

### C. Guru Desain Komunikasi Visual (DKV)
- **Nama**: Ni Luh Putu Dian, S.Sn.
- **Username / NIP**: `guru_dkv` (atau NIP: `198907122014022001`)
- **Kata Sandi**: `guru123`
- **Peran**: `guru`
- **Kejuruan**: Desain Komunikasi Visual (ID Jurusan: 12)

---

## 3. Akun Siswa (Pengirim Berita Sekolah)

Siswa melakukan pendaftaran mandiri atau menggunakan akun berikut. Siswa hanya dapat membuat konten kategori Berita (tidak diizinkan membuat Pengumuman). Setiap berita yang dibuat siswa otomatis berstatus `pending` dan memerlukan persetujuan Guru Jurusan atau Admin sebelum tayang di portal publik.

### A. Siswa RPL
- **Nama**: I Putu Rama Aditya
- **Username / NIS**: `22001`
- **Kata Sandi**: `siswa123`
- **Peran**: `siswa`
- **Kejuruan**: Rekayasa Perangkat Lunak
- **Status Akun**: Aktif (`active`)

### B. Siswa TKJ
- **Nama**: Ni Kadek Ayu Lestari
- **Username / NIS**: `22002`
- **Kata Sandi**: `siswa123`
- **Peran**: `siswa`
- **Kejuruan**: Teknik Komputer dan Jaringan
- **Status Akun**: Aktif (`active`)

### C. Siswa DKV
- **Nama**: I Komang Bayu Nugraha
- **Username / NIS**: `22003`
- **Kata Sandi**: `siswa123`
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
