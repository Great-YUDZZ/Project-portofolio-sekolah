<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MajorController extends Controller
{
    public function index(Request $request): View
    {
        $fieldSlug = $request->query('bidang');
        $fields = Field::withCount('majors')->orderBy('id')->get();

        $majorsQuery = Major::with('field')->withCount('classrooms')->orderBy('order_index');
        if ($fieldSlug) {
            $majorsQuery->whereHas('field', fn ($q) => $q->where('slug', $fieldSlug));
        }

        $majors = $majorsQuery->get();

        return view('public.majors.index', compact('fields', 'majors', 'fieldSlug'));
    }

    public function show(string $slug): View
    {
        $slugClean = strtolower(trim($slug));

        $major = Major::with(['field', 'classrooms', 'studentWorks', 'achievements'])
            ->where('slug', $slugClean)
            ->first();

        if (! $major) {
            $major = Major::with(['field', 'classrooms', 'studentWorks', 'achievements'])
                ->where('code', strtoupper($slugClean))
                ->first();
        }

        if (! $major) {
            $slugAliases = [
                'teknik-komputer-dan-jaringan' => 'TKJ',
                'teknik-komputer-jaringan' => 'TKJ',
                'rekayasa-perangkat-lunak' => 'RPL',
                'desain-komunikasi-visual' => 'DKV',
                'teknik-pemesinan' => 'TPM',
                'teknik-mesin' => 'TPM',
                'teknik-pendingin-dan-tata-udara' => 'TPTUP',
                'teknik-pendingin-tata-udara' => 'TPTUP',
                'teknik-instalasi-tenaga-listrik' => 'TITL',
                'teknik-tenaga-listrik' => 'TITL',
                'teknik-konstruksi-dan-properti' => 'TKP',
                'teknik-konstruksi-properti' => 'TKP',
                'desain-pemodelan-dan-informasi-bangunan' => 'DPIB',
                'desain-pemodelan-informasi-bangunan' => 'DPIB',
                'teknik-kendaraan-ringan' => 'TKR',
                'teknik-kendaraan-ringan-otomotif' => 'TKR',
                'teknik-sepeda-motor' => 'TSM',
                'teknik-bisnis-sepeda-motor' => 'TSM',
                'teknik-audio-video' => 'TAV',
                'teknik-elektronika-industri' => 'ELIN',
                'produksi-dan-siaran-program-televisi' => 'PRF',
                'produksi-siaran-program-televisi' => 'PRF',
            ];

            if (isset($slugAliases[$slugClean])) {
                $major = Major::with(['field', 'classrooms', 'studentWorks', 'achievements'])
                    ->where('code', $slugAliases[$slugClean])
                    ->first();
            }
        }

        if (! $major) {
            abort(404);
        }

        $otherMajors = Major::where('id', '!=', $major->id)
            ->orderBy('order_index')
            ->get();

        $enrichedData = $this->getEnrichedMajorData($major->code);

        return view('public.majors.show', compact('major', 'otherMajors', 'enrichedData'));
    }

    private function getEnrichedMajorData(string $code): array
    {
        $code = strtoupper(trim($code));

        $data = [
            'TPTUP' => [
                'scheme' => 'Teknisi Refrigerasi & Tata Udara Domestik-Komersial (KKNI Level II)',
                'unit_codes' => ['GARUDA-REF-01', 'BNSP-TPTUP-02', 'DAIKIN-COE-CERT'],
                'labs' => [
                    ['name' => 'Daikin Center of Excellence (CoE)', 'desc' => 'Ruang simulasi VRV (Variable Refrigerant Volume) dan instalasi AC Inverter multi-split berstandar Daikin Jepang.'],
                    ['name' => 'Bengkel Perakitan & Servis Tata Udara', 'desc' => 'Fasilitas vakum, recovery refrigeran ramah lingkungan R32/R410A, dan pengujian siklus kompresi uap.'],
                    ['name' => 'Laboratorium Kelistrikan Sistem Pendingin', 'desc' => 'Panel pengawatan kendali motor kompresor, relay, kontaktor, termostat, dan pengujian inverter digital.'],
                ],
                'partners' => ['PT Daikin Airconditioning Indonesia', 'PT Panasonic Gobel Indonesia', 'ASISI Bali (Asosiasi Praktisi Pendingin)', 'Daikin Proshop Denpasar'],
                'fase_e' => ['Dasar-dasar Ketenagalistrikan & Termodinamika', 'Pekerjaan Mekanik Logam & Pemipaan (Brazing)', 'Keselamatan & Kesehatan Kerja Lingkungan Hidup (K3LH)'],
                'fase_f' => ['Sistem Refrigerasi Domestik & Komersial', 'Instalasi & Perawatan Air Conditioning (AC)', 'Sistem Kontrol Kelistrikan & Inverter Tata Udara', 'Teaching Factory Servis & Perawatan AC'],
            ],
            'TKJ' => [
                'scheme' => 'Teknisi Utama Jaringan Komputer & Fiber Optic (KKNI Level II)',
                'unit_codes' => ['MTCNA-ACADEMY', 'CCNA-READY', 'BNSP-TKJ-KOMPUTER'],
                'labs' => [
                    ['name' => 'Laboratorium Fiber Optic & Splicing', 'desc' => 'Peralatan fusion splicer berpresisi tinggi, cleaver mikron, OTDR, dan media converter fiber to the home (FTTH).'],
                    ['name' => 'Laboratorium Server & Routing Data Center', 'desc' => 'Rack server blade, managed switch Cisco Catalyst, MikroTik Cloud Core Router, dan virtualisasi Proxmox/VMware.'],
                    ['name' => 'Lab Perakitan Komputer & Maintenance TIK', 'desc' => 'Pusat diagnosa hardware, instalasi sistem operasi Linux/Windows, dan troubleshooting peripheral jaringan.'],
                ],
                'partners' => [
                    ['name' => 'PT Telkom Indonesia (Persero) Tbk', 'logo' => '/images/partners/telkom.svg', 'sector' => 'Telekomunikasi & Fiber Optic'],
                    ['name' => 'PT Indonesia Comnets Plus (PLN Icon+)', 'logo' => '/images/partners/pln.svg', 'sector' => 'Infrastruktur Jaringan & Cloud'],
                    ['name' => 'MikroTik Academy Latvia', 'logo' => '/images/partners/mikrotik.svg', 'sector' => 'Sertifikasi Jaringan Internasional'],
                    ['name' => 'APJII Bali', 'logo' => '/images/partners/apjii.svg', 'sector' => 'Penyelenggara Jasa Internet Indonesia'],
                ],
                'fase_e' => ['Dasar-dasar Teknik Jaringan Komputer & Telekomunikasi', 'Perakitan Hardware Komputer & Sistem Operasi', 'K3LH & Etika Profesi Teknisi Jaringan'],
                'fase_f' => ['Perencanaan & Penggelaran Jaringan Fiber Optic', 'Administrasi Infrastruktur Jaringan (Routing & Switching)', 'Administrasi Sistem Jaringan (Linux Server, DNS, Mail, Web)', 'Keamanan Jaringan & Cloud Computing'],
            ],
            'RPL' => [
                'scheme' => 'Junior Web Developer & Mobile Application Programmer (KKNI Level II)',
                'unit_codes' => ['BNSP-PROG-WEB-01', 'LSP-P1-RPL-DEV', 'CERT-CODE-ID'],
                'labs' => [
                    ['name' => 'Laboratorium Rekayasa Software & Fullstack Dev', 'desc' => 'Workstation developer berperforma tinggi untuk rekayasa web modern (Laravel, React, Tailwind, PostgreSQL).'],
                    ['name' => 'Inkubator Aplikasi Mobile & IoT Testing', 'desc' => 'Perangkat pengujian multi-platform Android/iOS, board mikrokontroler ESP32, dan gateway cloud API.'],
                    ['name' => 'Lab Kompetensi Pemrograman & Karantina LKS', 'desc' => 'Area pengembangan algoritma intensif untuk persiapan Lomba Kompetensi Siswa (LKS) Web Technologies.'],
                ],
                'partners' => [
                    ['name' => 'PT Gamatechno Indonesia', 'logo' => '/images/partners/gamatechno.svg', 'sector' => 'Enterprise Software & Smart City'],
                    ['name' => 'Mitrais Software House Bali', 'logo' => '/images/partners/mitrais.svg', 'sector' => 'Software Development & Offshore IT'],
                    ['name' => 'Suitmedia Digital Agency', 'logo' => '/images/partners/suitmedia.svg', 'sector' => 'Digital Transformation & Web App'],
                    ['name' => 'Dicoding Indonesia', 'logo' => '/images/partners/dicoding.svg', 'sector' => 'Platform Pelatihan & Sertifikasi IT'],
                ],
                'fase_e' => ['Dasar Pemrograman Terstruktur (Python/JavaScript)', 'Desain Basis Data Relasional & SQL', 'Prinsip Algoritma & Logika Berpikir Komputasional'],
                'fase_f' => ['Pemrograman Berorientasi Objek & Framework Modern (Laravel)', 'Pengembangan Web Frontend Responsif & RESTful API', 'Pemrograman Aplikasi Perangkat Bergerak (Mobile)', 'Basis Data Terdistribusi & Version Control (Git)'],
            ],
            'DKV' => [
                'scheme' => 'Desainer Grafis Muda & Operator Komputer Grafis (KKNI Level II)',
                'unit_codes' => ['BNSP-DESAIN-GRAFIS', 'LSP-DKV-KREATIF', 'ADOBE-CERT-READY'],
                'labs' => [
                    ['name' => 'Studio Komputer Grafis & Digital Imaging', 'desc' => 'Workstation grafis berlayar IPS akurasi warna tinggi, software Adobe Creative Cloud, dan CorelDRAW Suite.'],
                    ['name' => 'Studio Fotografi & Green Screen Lighting', 'desc' => 'Kamera DSLR/Mirrorless profesional, continuous softbox lighting, backdrop seamless, dan tripod fluid head.'],
                    ['name' => 'Workshop Sablon & Digital Printing TeFa', 'desc' => 'Mesin cetak digital indoor/outdoor, mesin cutting sticker presisi, dan transfer heat press.'],
                ],
                'partners' => [
                    ['name' => 'Bali Animasi Solusi Ekakarsa (BASE)', 'logo' => '/images/partners/base_animasi.svg', 'sector' => 'Studio Animasi 2D/3D & CGI'],
                    ['name' => 'Studio Desain Seminyak', 'logo' => '/images/partners/casa_amertha.svg', 'sector' => 'Konsultan Desain Grafis & Kreatif'],
                    ['name' => 'Percetakan Grafika Utama Denpasar', 'logo' => '/images/partners/damar_bumi.svg', 'sector' => 'Industri Percetakan & Packaging'],
                    ['name' => 'Asosiasi Desain Grafis Indonesia (ADGI)', 'logo' => '/images/partners/adgi.svg', 'sector' => 'Asosiasi Profesi Desainer Grafis'],
                ],
                'fase_e' => ['Dasar Seni Rupa, Tipografi & Sketsa', 'Prinsip Desain Komunikasi Visual & Komposisi', 'Pengenalan Perangkat Lunak Desain Grafis'],
                'fase_f' => ['Desain Identitas Visual (Branding & Logo)', 'Desain Publikasi Cetak & Media Periklanan', 'Fotografi Komersial & Videografi Pendek', 'Desain UI/UX Aplikasi & Konten Media Digital'],
            ],
            'TPM' => [
                'scheme' => 'Operator Mesin Bubut & Mesin CNC Milling (KKNI Level II)',
                'unit_codes' => ['BNSP-LOGAM-MESIN', 'CNC-MILL-CERT', 'LATHE-OPERATOR'],
                'labs' => [
                    ['name' => 'Bengkel Pemesinan CNC Logam Presisi', 'desc' => 'Mesin CNC Milling 3-Axis dan CNC Bubut industri lengkap dengan simulator CAD/CAM (Mastercam/Inventor).'],
                    ['name' => 'Bengkel Bubut & Frais Konvensional', 'desc' => 'Deretan 16 mesin bubut presisi tinggi, mesin frais universal, mesin gerinda datar, dan alat ukur mikrometer.'],
                    ['name' => 'Ruang Fabrikasi Pengelasan & Kerja Bangku', 'desc' => 'Meja kerja bangku rata, kikir presisi, mesin bor tegak, dan fasilitas las SMAW/GMAW terstandar K3.'],
                ],
                'partners' => [
                    ['name' => 'PT Astra International Tbk', 'logo' => '/images/partners/toyota.svg', 'sector' => 'Manufaktur Komponen Otomotif'],
                    ['name' => 'PT United Tractors Tbk', 'logo' => '/images/partners/united_tractors.svg', 'sector' => 'Alat Berat & Rekayasa Mesin'],
                    ['name' => 'PT Komatsu Indonesia', 'logo' => '/images/partners/komatsu.svg', 'sector' => 'Pemesinan Presisi & Heavy Equipment'],
                    ['name' => 'Balai Latihan Kerja Industri', 'logo' => '/images/partners/bkk_disnaker.svg', 'sector' => 'Standardisasi Uji Logam'],
                ],
                'fase_e' => ['Dasar Gambar Teknik Mesin & Standar ISO', 'Pekerjaan Dasar Mekanik & Pengukuran Presisi', 'K3LH Keselamatan Kerja Bengkel Manufaktur'],
                'fase_f' => ['Pemesinan Bubut Konvensional Tingkat Lanjut', 'Pemesinan Frais & Gerinda Presisi', 'Pemrograman Mesin CNC (Bubut & Milling CAD/CAM)', 'Teaching Factory Produksi Komponen Mesin'],
            ],
            'TITL' => [
                'scheme' => 'Teknisi Instalasi Penerangan & Tenaga Listrik Bangunan (KKNI Level II)',
                'unit_codes' => ['BNSP-LISTRIK-01', 'K3-LISTRIK-INDUSTRI', 'PLN-READY'],
                'labs' => [
                    ['name' => 'Laboratorium Kendali Motor Listrik & PLC', 'desc' => 'Modul PLC Omron/Schneider, panel kontaktor magnetik, inverter frekuensi motor, dan HMI touch panel.'],
                    ['name' => 'Bengkel Instalasi Penerangan Bangunan', 'desc' => 'Bilik simulasi instalasi rumah tinggal, saklar cerdas smart home, pipa konduit, dan grounding tester.'],
                    ['name' => 'Laboratorium Pembangkit Energi Terbarukan', 'desc' => 'Trainer sistem Pembangkit Listrik Tenaga Surya (PLTS) On-Grid/Off-Grid dan solar charge controller.'],
                ],
                'partners' => [
                    ['name' => 'PT PLN (Persero) UID Bali', 'logo' => '/images/partners/pln.svg', 'sector' => 'Distribusi Tenaga Listrik Nasional'],
                    ['name' => 'PT Schneider Electric Indonesia', 'logo' => '/images/partners/schneider.svg', 'sector' => 'Otomasi Kelistrikan & Energy Management'],
                    ['name' => 'AKLI Bali (Asosiasi Kontraktor Listrik)', 'logo' => '/images/partners/akli.svg', 'sector' => 'Kontraktor Kelistrikan Terakreditasi'],
                    ['name' => 'PT Bambang Djaja', 'logo' => '/images/partners/pln.svg', 'sector' => 'Pabrikasi Transformator & Distribusi'],
                ],
                'fase_e' => ['Dasar Kelistrikan & Teori Rangkaian Listrik', 'Pengukuran Besaran Listrik (Multimeter, Megger, Earth Tester)', 'Standar PUIL (Persyaratan Umum Instalasi Listrik) & K3'],
                'fase_f' => ['Instalasi Penerangan Listrik Rumah Tinggal & Bertingkat', 'Instalasi Tenaga Listrik & Panel Distribusi', 'Sistem Pengendalian Motor Listrik & PLC Industri', 'Instalasi Sistem Solar Cell (PLTS) Mandiri'],
            ],
            'TKP' => [
                'scheme' => 'Pelaksana Konstruksi Bangunan Gedung & Perumahan (KKNI Level II)',
                'unit_codes' => ['BNSP-KONSTRUKSI-SIPIL', 'SURVEYOR-LEVEL-2', 'RAB-ESTIMATOR'],
                'labs' => [
                    ['name' => 'Laboratorium Ukur Tanah & Geodesi', 'desc' => 'Total Station digital, Theodolite optik/elektronik, Waterpass autolevel, dan software pemetaan kontur tanah.'],
                    ['name' => 'Bengkel Kerja Kayu & Struktur Beton Bertulang', 'desc' => 'Mesin serut kayu meja, circular saw pengaman, cetakan silinder beton, dan slump test kualitas adukan.'],
                    ['name' => 'Studio Gambar Teknik Arsitektur & Perhitungan RAB', 'desc' => 'Workstation CAD teknik sipil, software estimasi biaya konstruksi, dan plotting cetak gambar kerja A1/A0.'],
                ],
                'partners' => [
                    ['name' => 'PT Wijaya Karya (Persero) Tbk', 'logo' => '/images/partners/wika.svg', 'sector' => 'Konstruksi Sipil & Infrastruktur Nasional'],
                    ['name' => 'PT Adhi Karya (Persero) Tbk', 'logo' => '/images/partners/adhi_karya.svg', 'sector' => 'BUMN Konstruksi & Rekayasa Gedung'],
                    ['name' => 'Departemen PUPR Provinsi Bali', 'logo' => '/images/partners/pupr.svg', 'sector' => 'Regulasi Infrastruktur Daerah'],
                    ['name' => 'Ikatan Arsitek Indonesia (IAI) Daerah Bali', 'logo' => '/images/partners/iai_bali.svg', 'sector' => 'Asosiasi Profesi Arsitektur & Sipil'],
                ],
                'fase_e' => ['Dasar Konstruksi Bangunan & Gambar Teknik Sipil', 'Dasar Pengukuran Tanah (Surveying) & K3LH', 'Statika Bangunan & Karakteristik Material Konstruksi'],
                'fase_f' => ['Konstruksi Bangunan Gedung (Beton, Baja, Kayu)', 'Estimasi Biaya Konstruksi & Rencana Anggaran Biaya (RAB)', 'Manajemen Pelaksanaan Proyek Perumahan', 'Pengukuran & Pemetaan Digital Menggunakan Total Station'],
            ],
            'DPIB' => [
                'scheme' => 'Juru Gambar Arsitektur / Drafter BIM (KKNI Level II)',
                'unit_codes' => ['BNSP-DRAFTER-BIM', 'AUTOCAD-CERT-READY', 'REVIT-BUILDING'],
                'labs' => [
                    ['name' => 'Studio Pemodelan Informasi Bangunan (BIM Studio)', 'desc' => 'PC grafis arsitektur untuk software Autodesk AutoCAD, Revit Architecture, SketchUp, dan Lumion Renderer.'],
                    ['name' => 'Studio Maket & Prototyping Struktur', 'desc' => 'Meja potong akrilik, alat potong presisi styrofoam arsitektur, dan 3D Printer cetak maket perumahan.'],
                    ['name' => 'Ruang Presentasi & Virtual Tour Desain', 'desc' => 'Display layar besar untuk simulasi walk-through 3D interior/eksterior bangunan dan presentasi klien.'],
                ],
                'partners' => [
                    ['name' => 'Ikatan Arsitek Indonesia (IAI) Bali', 'logo' => '/images/partners/iai_bali.svg', 'sector' => 'Asosiasi Profesi Arsitektur Nasional'],
                    ['name' => 'Autodesk Education Network', 'logo' => '/images/partners/autodesk.svg', 'sector' => 'Sertifikasi CAD & BIM Internasional'],
                    ['name' => 'PT Pembangunan Perumahan (PP)', 'logo' => '/images/partners/ptpp.svg', 'sector' => 'BUMN Konstruksi & BIM Modeling'],
                    ['name' => 'Konsultan Arsitektur Casa Amertha', 'logo' => '/images/partners/casa_amertha.svg', 'sector' => 'Perencanaan Desain & Interior'],
                ],
                'fase_e' => ['Dasar Menggambar Proyeksi Arsitektur & Sketsa', 'Mekanika Teknik & Karakter Bahan Bangunan', 'Pengenalan Software Computer-Aided Design (CAD 2D)'],
                'fase_f' => ['Gambar Desain Arsitektur 2D & 3D Interior/Eksterior', 'Building Information Modeling (BIM) Arsitektur', 'Gambar Konstruksi Utilitas Bangunan Gedung & MEP', 'Perhitungan Rencana Kerja dan Syarat (RKS) serta Estimasi Biaya'],
            ],
            'TKR' => [
                'scheme' => 'Teknisi Kendaraan Ringan Otomotif (KKNI Level II)',
                'unit_codes' => ['BNSP-OTOMOTIF-TKR', 'ASTRA-DIAGNOSIS', 'EFI-SPECIALIST'],
                'labs' => [
                    ['name' => 'Bengkel Servis Kendaraan Ringan (Car Service Bay)', 'desc' => 'Two-post car lift, four-post wheel alignment scissoring lift, dan tire changer otomatis.'],
                    ['name' => 'Laboratorium Engine Management & Diagnostik EFI', 'desc' => 'Scan tool diagnostik OBD-II digital, injector cleaner and tester, dan trainer mesin Electronic Fuel Injection (EFI).'],
                    ['name' => 'Bengkel Sistem Rem, Suspensi & Transmisi', 'desc' => 'Brake drum/disc lathe, hydraulic press bearing, dan simulator transmisi otomatis/manual.'],
                ],
                'partners' => [
                    ['name' => 'PT Astra International Tbk - Toyota Auto2000', 'logo' => '/images/partners/toyota.svg', 'sector' => 'Authorized Dealer & Service Bengkel Resmi'],
                    ['name' => 'PT Suzuki Indomobil Sales', 'logo' => '/images/partners/suzuki.svg', 'sector' => 'Manufaktur & Layanan Purnajual Mobil'],
                    ['name' => 'PT Astra Daihatsu Motor', 'logo' => '/images/partners/daihatsu.svg', 'sector' => 'Perakitan & Bengkel Resmi Mobil'],
                    ['name' => 'Bengkel Resmi Honda Denpasar', 'logo' => '/images/partners/honda.svg', 'sector' => 'Servis & Diagnostik Mesin Modern'],
                ],
                'fase_e' => ['Dasar Otomotif & Siklus Kerja Motor Bakar', 'Penggunaan Alat Ukur Presisi Otomotif (Bore Gauge, Micrometer)', 'K3LH Keselamatan Kerja Bengkel Otomotif'],
                'fase_f' => ['Pemeliharaan Mesin Kendaraan Ringan (Engine Tune-Up EFI)', 'Pemeliharaan Sasis & Sistem Pemindah Tenaga (Transmisi, Rem ABS)', 'Sistem Kelistrikan Bodi, AC Mobil & Central Lock', 'Diagnosis Komputerisasi Kerusakan Kendaraan (Engine Scanner)'],
            ],
            'TSM' => [
                'scheme' => 'Teknisi Sepeda Motor Injeksi & Kelistrikan (KKNI Level II)',
                'unit_codes' => ['BNSP-MOTOR-TSM', 'AHASS-CERT-READY', 'YAMAHA-YTA-READY'],
                'labs' => [
                    ['name' => 'Bengkel Kerja Standar Dealer Resmi Sepeda Motor', 'desc' => '10 bike lift hidrolik dengan set perkakas lengkap (mechanic tool set) standar pabrikan AHASS & Yamaha.'],
                    ['name' => 'Laboratorium Diagnostik Injeksi PGM-FI / YMJET-FI', 'desc' => 'Hi-DS scanner motor, fuel pressure gauge tester, battery load tester, dan tachometer digital.'],
                    ['name' => 'Workshop Inovasi Konversi Motor Listrik Mandiri', 'desc' => 'Fasilitas rekayasa konversi sepeda motor konvensional menjadi kendaraan listrik berbasis baterai lithium.'],
                ],
                'partners' => [
                    ['name' => 'PT Astra Honda Motor (Astra Motor Bali)', 'logo' => '/images/partners/honda.svg', 'sector' => 'Pabrikan & Jaringan Bengkel AHASS'],
                    ['name' => 'PT Yamaha Indonesia Motor Mfg', 'logo' => '/images/partners/yamaha.svg', 'sector' => 'Pabrikan & Akademi Teknisi Yamaha YTA'],
                    ['name' => 'Bengkel Resmi AHASS Denpasar', 'logo' => '/images/partners/honda.svg', 'sector' => 'Layanan Pemeliharaan Motor Injeksi'],
                    ['name' => 'Komunitas Konversi Kendaraan Listrik Bali', 'logo' => '/images/partners/pln.svg', 'sector' => 'Inovasi Konversi Motor Listrik EV'],
                ],
                'fase_e' => ['Dasar Mesin 2 Tak & 4 Tak serta Peralatan Tangan (Hand Tools)', 'Pengenalan Sistem Bahan Bakar & Pengapian Sepeda Motor', 'K3LH dan Budaya Kerja Industri Otomotif 5R'],
                'fase_f' => ['Perawatan Berkala Mesin Sepeda Motor Injeksi', 'Perawatan Sasis, Suspensi & Sistem Pengereman CBS/ABS', 'Sistem Kelistrikan Penerangan, Starter & Smart Key System', 'Teknologi Kendaraan Sepeda Motor Listrik'],
            ],
            'TAV' => [
                'scheme' => 'Teknisi Perbaikan Peralatan Audio Video & Smart Electronics (KKNI Level II)',
                'unit_codes' => ['BNSP-AUDIO-VIDEO', 'SMART-TV-REPAIR', 'ACOUSTIC-ENGINEER'],
                'labs' => [
                    ['name' => 'Laboratorium Reparasi Audio Video & Smart Display', 'desc' => 'Oscilloscope dual-channel 100MHz, soldering station suhu terkendali, sinyal generator, dan panel uji Smart TV LED.'],
                    ['name' => 'Studio Akustik Ruang & Sound Reinforcement', 'desc' => 'Mixer audio digital, sistem tata suara daya tinggi, mikrofon wireless UHF, dan software analisis frekuensi suara.'],
                    ['name' => 'Workshop Pembuatan PCB & Perancangan Sirkuit', 'desc' => 'Fasilitas etching PCB, bor mini presisi tinggi, dan software perancangan skematik Proteus / Altium.'],
                ],
                'partners' => [
                    ['name' => 'PT Sharp Electronics Indonesia', 'logo' => '/images/partners/sharp.svg', 'sector' => 'Elektronika Konsumen & Smart Display'],
                    ['name' => 'PT Polytron Indonesia', 'logo' => '/images/partners/polytron.svg', 'sector' => 'Audio Video Engineering & Akustik'],
                    ['name' => 'PT Panasonic Gobel Indonesia', 'logo' => '/images/partners/panasonic.svg', 'sector' => 'Smart Home & Sound Reinforcement'],
                    ['name' => 'PT Daikin Airconditioning Indonesia', 'logo' => '/images/partners/daikin.svg', 'sector' => 'Tata Udara & Elektronika Terapan'],
                ],
                'fase_e' => ['Dasar Komponen Elektronika Pasif & Aktif', 'Pekerjaan Bengkel Elektronika, Soldering & Desolering', 'Pengukuran Sinyal Listrik Menggunakan Osiloskop'],
                'fase_f' => ['Rangkaian Penguat Audio & Pemrosesan Sinyal Suara', 'Sistem Penerima Televisi LCD/LED & Smart TV', 'Instalasi Sistem Sound System Panggung & Akustik', 'Perbaikan Peralatan Elektronika Audio Video Rumah Tangga'],
            ],
            'ELIN' => [
                'scheme' => 'Teknisi Otomasi Industri & Instrumentasi Elektronika (KKNI Level II)',
                'unit_codes' => ['BNSP-OTOMASI-ELIN', 'PLC-SCADA-SYSTEM', 'INDUSTRIAL-SENSORS'],
                'labs' => [
                    ['name' => 'Laboratorium PLC, Pneumatik & Elektro-Pneumatik', 'desc' => 'Trainer PLC Siemens S7-1200 / Omron, katup selenoid pneumatik, kompresor udara presisi, dan silinder kerja ganda.'],
                    ['name' => 'Laboratorium Mikrokontroler & Sistem Sensor IoT', 'desc' => 'Kit mikrokontroler STM32 / Arduino / ESP32, sensor industri (proksimiti, suhu RTD, optical encoder), dan sistem SCADA.'],
                    ['name' => 'Bengkel Panel Kontrol Otomasi Pabrik', 'desc' => 'Perakitan panel kontrol industri, pengawatan rel MCB, inverter frekuensi motor 3 fasa, dan tombol emergency stop.'],
                ],
                'partners' => [
                    ['name' => 'PT Schneider Electric Manufacturing', 'logo' => '/images/partners/schneider.svg', 'sector' => 'Sistem PLC & Otomasi Pabrik'],
                    ['name' => 'PT Omron Electronics Indonesia', 'logo' => '/images/partners/omron.svg', 'sector' => 'Sensor Industri & Kontrol Otomasi'],
                    ['name' => 'PT Siemens Indonesia', 'logo' => '/images/partners/siemens.svg', 'sector' => 'Sistem SCADA & Instrumentasi'],
                    ['name' => 'PT United Tractors Tbk', 'logo' => '/images/partners/united_tractors.svg', 'sector' => 'Mekatronika & Alat Berat'],
                ],
                'fase_e' => ['Dasar Elektronika Analog & Rangkaian Digital', 'Pengenalan Sensor Industri & Transduser', 'K3LH Keselamatan Kerja Otomasi Pabrik'],
                'fase_f' => ['Pemrograman Programmable Logic Controller (PLC) & HMI', 'Sistem Kontrol Pneumatik & Elektro-Pneumatik Industri', 'Sistem Instrumentasi & Kontrol Proses (PID Controller)', 'Robotika Industri Sederhana & Otomasi Pabrik Berbasis IoT'],
            ],
            'PRF' => [
                'scheme' => 'Asisten Produser Film & Penata Kamera / Editor Video (KKNI Level II)',
                'unit_codes' => ['BNSP-BROADCAST-FILM', 'CINEMATOGRAPHY-LEVEL-2', 'VIDEO-EDITOR-PRO'],
                'labs' => [
                    ['name' => 'Studio Produksi Film & Live Broadcast SKENSA TV', 'desc' => 'Kamera cinema 4K profesional, switcher siaran langsung multi-kamera, teleprompter, dan lighting gaffer kit pro.'],
                    ['name' => 'Lab Editing & Color Grading Pascaproduksi', 'desc' => 'Workstation editing dengan monitor kalibrasi warna 100% sRGB, DaVinci Resolve Studio, dan Premiere Pro.'],
                    ['name' => 'Studio Perekaman Suara (Foley & Dubbing Room)', 'desc' => 'Ruang kedap suara berperekat busa akustik peredam, boom mic shotgun, dan audio mixer monitoring.'],
                ],
                'partners' => [
                    ['name' => 'Bali TV Media Grup', 'logo' => '/images/partners/balitv.svg', 'sector' => 'Stasiun Televisi Siaran Berita & Dokumenter'],
                    ['name' => 'Bali Animasi Solusi Ekakarsa (BASE)', 'logo' => '/images/partners/base_animasi.svg', 'sector' => 'Post-Production, CGI & Editing'],
                    ['name' => 'Indonesian Cinematographers Society (ICS)', 'logo' => '/images/partners/imaji.svg', 'sector' => 'Asosiasi Profesi Sinematografi'],
                    ['name' => 'Studio Film Independen Bali', 'logo' => '/images/partners/damar_bumi.svg', 'sector' => 'Production House Film & Kreatif'],
                ],
                'fase_e' => ['Dasar Estetika Audio Visual & Bahasa Sinema', 'Pengoperasian Kamera Video & Tata Cahaya Dasar', 'Pengenalan Perangkat Lunak Editing Video'],
                'fase_f' => ['Manajemen Produksi Film Pendek & Dokumenter', 'Tata Sinematografi & Tata Artistik Set Produksi', 'Penyuntingan Gambar Bergerak (Editing & Color Grading)', 'Perekaman dan Penataan Suara Film (Sound Design)'],
            ],
        ];

        return $data[$code] ?? [
            'scheme' => 'Teknisi Kejuruan Vokasi Terakreditasi BNSP (KKNI Level II)',
            'unit_codes' => ['BNSP-VOKASI-SKENSA', 'LSP-P1-KOMPETEN'],
            'labs' => [
                ['name' => 'Laboratorium Praktik Khusus Kejuruan', 'desc' => 'Fasilitas pembelajaran kejuruan terpadu dengan perlengkapan standar kompetensi industri.'],
                ['name' => 'Bengkel Kerja Praktik Siswa', 'desc' => 'Area pengerjaan tugas proyek, uji kompetensi keahlian, dan simulasi kerja nyata.'],
            ],
            'partners' => [
                ['name' => 'PT Telkom Indonesia (Persero) Tbk', 'logo' => '/images/partners/telkom.svg', 'sector' => 'Telekomunikasi & Jaringan'],
                ['name' => 'PT PLN (Persero)', 'logo' => '/images/partners/pln.svg', 'sector' => 'Energi & Ketenagalistrikan'],
                ['name' => 'Balai Sertifikasi Profesi BNSP', 'logo' => '/images/partners/bnsp_lsp.svg', 'sector' => 'Lembaga Sertifikasi Profesi'],
            ],
            'fase_e' => ['Dasar-dasar Kejuruan Terpadu', 'K3LH Keselamatan Kerja', 'Pengenalan Peralatan Industri'],
            'fase_f' => ['Kompetensi Kejuruan Lanjut', 'Projek Penguatan Kreatif Kejuruan', 'Praktik Kerja Lapangan (PKL) Industri'],
        ];
    }
}
