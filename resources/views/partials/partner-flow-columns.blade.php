@php
    // Single source of truth for 24 verified industry partners of SMKN 1 Denpasar
    $flowPartners = [
        // Column 1 items
        'daikin' => [
            'name'    => 'Daikin AC',
            'role'    => 'Center of Excellence HVAC',
            'color'   => '#00A0E9',
            'rgb'     => '0,160,233',
            'logo'    => '/images/partners/daikin.svg',
            'jurusan' => 'Teknik Pendingin & Tata Udara (TPTUP)',
            'bentuk'  => 'Center of Excellence Pertama Luar Jawa',
            'slug'    => 'teknik-pendingin-dan-tata-udara',
            'detail'  => 'Fasilitas Daikin Center of Excellence seluas 142 m2 diresmikan 7 Maret 2025 di SMKN 1 Denpasar. Dilengkapi teknologi pendingin inverter VRV mutakhir untuk sertifikasi teknisi standar industri internasional.',
        ],
        'honda' => [
            'name'    => 'Astra Honda',
            'role'    => 'Kurikulum TBSM & AHASS',
            'color'   => '#E60012',
            'rgb'     => '230,0,18',
            'logo'    => '/images/partners/honda.svg',
            'jurusan' => 'Teknik Sepeda Motor (TSM)',
            'bentuk'  => 'Kelas Industri Kurikulum TBSM',
            'slug'    => 'teknik-sepeda-motor',
            'detail'  => 'Sinkronisasi kurikulum resmi Astra Honda Motor melalui penyediaan unit sepeda motor injeksi generasi terbaru untuk praktik, sertifikasi instruktur, serta kuota rekrutmen mekanik resmi jaringan AHASS se-Bali.',
        ],
        'toyota' => [
            'name'    => 'Toyota Auto2000',
            'role'    => 'T-TEP & Bengkel TKR',
            'color'   => '#EB0A1E',
            'rgb'     => '235,10,30',
            'logo'    => '/images/partners/toyota.svg',
            'jurusan' => 'Teknik Kendaraan Ringan (TKR)',
            'bentuk'  => 'Vocational School Development & T-TEP',
            'slug'    => 'teknik-kendaraan-ringan',
            'detail'  => 'Sekolah binaan perdana Toyota (TMMIN) di Bali dengan donasi mesin peraga 2TR, standardisasi bengkel Teaching Factory SKENSA Auto Care, PKL 6 bulan di Auto2000 & Agung Toyota, serta sertifikasi teknisi roda empat.',
        ],
        'telkom' => [
            'name'    => 'Telkom Indonesia',
            'role'    => 'FTTH & Jaringan Cloud',
            'color'   => '#E4002B',
            'rgb'     => '228,0,43',
            'logo'    => '/images/partners/telkom.svg',
            'jurusan' => 'Teknik Komputer & Jaringan (TKJ)',
            'bentuk'  => 'Infrastruktur FTTH & Sertifikasi Jaringan',
            'slug'    => 'teknik-komputer-dan-jaringan',
            'detail'  => 'Kemitraan resmi instalasi jaringan fiber optic splicing, penyediaan perangkat praktik FTTH, program magang teknisi lapangan Telkom Akses, serta penyerapan lulusan melalui Job Fair tahunan.',
        ],
        'pln' => [
            'name'    => 'PLN Distribusi',
            'role'    => 'Konversi Motor Listrik P2B',
            'color'   => '#00A39D',
            'rgb'     => '0,163,157',
            'logo'    => '/images/partners/pln.svg',
            'jurusan' => 'Teknik Instalasi Tenaga Listrik (TITL)',
            'bentuk'  => 'TJSL Pelatihan Konversi Motor Listrik',
            'slug'    => 'teknik-instalasi-tenaga-listrik',
            'detail'  => 'Program binaan konversi motor BBM ke motor listrik (P2B E-Moto), edukasi keselamatan K3 ketenagalistrikan, serta PKL penanganan distribusi jaringan tegangan rendah dan menengah.',
        ],
        'yamaha' => [
            'name'    => 'Yamaha Motor',
            'role'    => 'Injeksi YDT & Balap Komunitas',
            'color'   => '#002C6C',
            'rgb'     => '0,44,108',
            'logo'    => '/images/partners/yamaha.svg',
            'jurusan' => 'Teknik Sepeda Motor (TSM)',
            'bentuk'  => 'Mitra Praktik & Teknologi Injeksi YDT',
            'slug'    => 'teknik-sepeda-motor',
            'detail'  => 'Pelatihan sistem injeksi menggunakan Yamaha Diagnostic Tools (YDT), sarana praktik sepeda motor, uji kompetensi kejuruan, serta penyaluran teknisi bengkel resmi Yamaha Bali.',
        ],

        // Column 2 items
        'nissan' => [
            'name'    => 'Nissan Gianyar',
            'role'    => 'Mitra PKL Resmi TKR',
            'color'   => '#C3002F',
            'rgb'     => '195,0,47',
            'logo'    => '/images/partners/nissan.svg',
            'jurusan' => 'Teknik Kendaraan Ringan (TKR)',
            'bentuk'  => 'Mitra PKL Resmi Dapodik Kemendikbud',
            'slug'    => 'teknik-kendaraan-ringan',
            'detail'  => 'Tercatat resmi dalam Dapodik Direktorat SMK Kemendikbudristek sebagai mitra industri Praktik Kerja Lapangan siswa TKR dalam perawatan mesin, sistem kelistrikan, dan rem kendaraan modern.',
        ],
        'jinom' => [
            'name'    => 'Jinom Network',
            'role'    => 'Internet Service Provider',
            'color'   => '#0B2A5B',
            'rgb'     => '11,42,91',
            'logo'    => '/images/partners/jinom.svg',
            'jurusan' => 'Teknik Komputer & Jaringan (TKJ)',
            'bentuk'  => 'Mitra Industri ISP & Jaringan Cloud',
            'slug'    => 'teknik-komputer-dan-jaringan',
            'detail'  => 'Perusahaan penyedia internet terkemuka di Bali yang membina siswa TKJ dalam administrasi routing BGP, manajemen bandwidth jaringan mikrotik, dan infrastruktur fiber optic metropolitan.',
        ],
        'nevelop' => [
            'name'    => 'Nevelop Tech',
            'role'    => 'Software House Bali',
            'color'   => '#1E293B',
            'rgb'     => '30,41,59',
            'logo'    => '/images/partners/nevelop.svg',
            'jurusan' => 'Rekayasa Perangkat Lunak (RPL)',
            'bentuk'  => 'Mitra PKL & Software Engineering Dapodik',
            'slug'    => 'rekayasa-perangkat-lunak',
            'detail'  => 'Tercatat resmi di Dapodik Direktorat SMK Kemendikbud sebagai mitra industri pengembangan software web modern, mobile app, dan asistensi workflow Git untuk siswa RPL.',
        ],
        'imaji' => [
            'name'    => 'Imaji Kryamaha',
            'role'    => 'Guru Tamu & Web Startup',
            'color'   => '#F5B700',
            'rgb'     => '245,183,0',
            'logo'    => '/images/partners/imaji.svg',
            'jurusan' => 'Rekayasa Perangkat Lunak (RPL)',
            'bentuk'  => 'Guru Tamu & Ekosistem Startup',
            'slug'    => 'rekayasa-perangkat-lunak',
            'detail'  => 'Pembinaan kompetensi full-stack web dan mobile development melalui mentoring proyek riil, review arsitektur kode oleh engineer senior, serta rekrutmen langsung junior developer.',
        ],
        'schneider' => [
            'name'    => 'Schneider Electric',
            'role'    => 'Otomasi PLC & Smart Panel',
            'color'   => '#3DCD58',
            'rgb'     => '61,205,88',
            'logo'    => '/images/partners/schneider.svg',
            'jurusan' => 'Teknik Otomasi & Listrik',
            'bentuk'  => 'Otomasi Industri & Smart Distribution',
            'slug'    => 'teknik-instalasi-tenaga-listrik',
            'detail'  => 'Penyediaan modul kendali PLC modern, sistem proteksi smart electrical panel, serta transfer knowledge otomasi gedung ramah energi bagi siswa vokasi.',
        ],
        'casa_amertha' => [
            'name'    => 'Casa Amertha',
            'role'    => 'Arsitektur & BIM Revit',
            'color'   => '#0B2A5B',
            'rgb'     => '11,42,91',
            'logo'    => '/images/partners/casa_amertha.svg',
            'jurusan' => 'Desain Pemodelan Bangunan (DPIB)',
            'bentuk'  => 'Mitra Arsitektur & BIM Dapodik Kemendikbud',
            'slug'    => 'desain-pemodelan-dan-informasi-bangunan',
            'detail'  => 'Tercatat di Dapodik Direktorat SMK untuk asistensi Building Information Modelling (BIM), gambar kerja konstruksi arsitektural Revit/CAD, dan perencanaan interior.',
        ],

        // Column 3 items
        'komatsu' => [
            'name'    => 'Komatsu Tools',
            'role'    => 'Alat Berat & CNC Mesin',
            'color'   => '#0043C0',
            'rgb'     => '0,67,192',
            'logo'    => '/images/partners/komatsu.svg',
            'jurusan' => 'Teknik Pemesinan (TPM)',
            'bentuk'  => 'Manufaktur Alat Berat & Pemesinan Presisi',
            'slug'    => 'teknik-pemesinan',
            'detail'  => 'Pembekalan fabrikasi logam presisi, standarisasi keselamatan kerja bengkel manufaktur berat, pemrograman mesin CNC, serta kunjungan industri alat berat.',
        ],
        'damar_bumi' => [
            'name'    => 'CV Damar Bumi',
            'role'    => 'Konstruksi & Struktur Gedung',
            'color'   => '#15803D',
            'rgb'     => '21,128,61',
            'logo'    => '/images/partners/damar_bumi.svg',
            'jurusan' => 'Teknik Konstruksi & Perumahan (TKP)',
            'bentuk'  => 'Mitra Lapangan Konstruksi Dapodik Kemendikbud',
            'slug'    => 'desain-pemodelan-dan-informasi-bangunan',
            'detail'  => 'Tercatat resmi di Dapodik Kemendikbud sebagai mitra Praktik Kerja Lapangan siswa teknik sipil konstruksi, bekisting, pembesian struktur, dan pengawasan proyek gedung.',
        ],
        'arta_yasa' => [
            'name'    => 'Arta Yasa Motor',
            'role'    => 'Bengkel Servis Roda Dua',
            'color'   => '#DC2626',
            'rgb'     => '220,38,38',
            'logo'    => '/images/partners/arta_yasa.svg',
            'jurusan' => 'Teknik Sepeda Motor (TSM)',
            'bentuk'  => 'Mitra Bengkel PKL Dapodik Kemendikbud',
            'slug'    => 'teknik-sepeda-motor',
            'detail'  => 'Tercatat di Dapodik Direktorat SMK untuk pelaksanaan PKL siswa teknik sepeda motor dalam perbaikan injeksi, transmisi otomatis, dan overhaul mesin.',
        ],
        'bnsp_lsp' => [
            'name'    => 'LSP-P1 BNSP',
            'role'    => 'Sertifikasi Profesi Nasional',
            'color'   => '#991B1B',
            'rgb'     => '153,27,27',
            'logo'    => '/images/partners/bnsp_lsp.svg',
            'jurusan' => 'Semua Konsentrasi Keahlian (13 Jurusan)',
            'bentuk'  => 'Sertifikasi Resmi BNSP (BNSP-LSP-757-ID)',
            'slug'    => 'profil',
            'detail'  => 'Lembaga Sertifikasi Profesi Pihak Kesatu resmi dengan lisensi KEP.1509/BNSP/V/2026 yang menguji dan menerbitkan sertifikasi kompetensi berstandar nasional BNSP di seluruh jurusan.',
        ],
        'united_tractors' => [
            'name'    => 'United Tractors',
            'role'    => 'Heavy Equipment & Fabrikasi',
            'color'   => '#F59E0B',
            'rgb'     => '245,158,11',
            'logo'    => '/images/partners/united_tractors.svg',
            'jurusan' => 'Teknik Pemesinan (TPM)',
            'bentuk'  => 'Aliansi Industri Alat Berat',
            'slug'    => 'teknik-pemesinan',
            'detail'  => 'Program pembekalan teknis perawatan mesin diesel alat berat, standarisasi fabrikasi mekanik, dan pelatihan keselamatan operasional lapangan.',
        ],
        'taksu_tech' => [
            'name'    => 'Taksu Tech',
            'role'    => 'Digital Web Engineering',
            'color'   => '#0284C7',
            'rgb'     => '2,132,199',
            'logo'    => '/images/partners/taksu_tech.svg',
            'jurusan' => 'Rekayasa Perangkat Lunak (RPL)',
            'bentuk'  => 'Software Agency & Mentoring Web',
            'slug'    => 'rekayasa-perangkat-lunak',
            'detail'  => 'Software house berbasis di Bali yang menyediakan tempat magang siswa RPL dalam membangun antarmuka web modern dan aplikasi mobile.',
        ],

        // Column 4 items
        'bamboomedia' => [
            'name'    => 'Bamboomedia',
            'role'    => 'Perangkat Lunak Pendidikan',
            'color'   => '#16A34A',
            'rgb'     => '22,163,74',
            'logo'    => '/images/partners/bamboomedia.svg',
            'jurusan' => 'Rekayasa Perangkat Lunak (RPL)',
            'bentuk'  => 'Mitra Edutech & Rekayasa Software',
            'slug'    => 'rekayasa-perangkat-lunak',
            'detail'  => 'Perusahaan software ternama di Bali yang menjadi wadah PKL siswa pemrograman dalam pengembangan aplikasi multimedia dan perangkat lunak.',
        ],
        'biznet' => [
            'name'    => 'Biznet Fiber',
            'role'    => 'Infrastruktur Jaringan Fiber',
            'color'   => '#FF5E00',
            'rgb'     => '255,94,0',
            'logo'    => '/images/partners/biznet.svg',
            'jurusan' => 'Teknik Komputer & Jaringan (TKJ)',
            'bentuk'  => 'Penyedia Akses Fiber Optik Terkemuka',
            'slug'    => 'teknik-komputer-dan-jaringan',
            'detail'  => 'Kemitraan penempatan kerja dan PKL siswa TKJ dalam instalasi kabel optik bawah tanah dan manajemen switch core metropolitan.',
        ],
        'panasonic' => [
            'name'    => 'Panasonic HVAC',
            'role'    => 'Teknologi Pendingin Udara',
            'color'   => '#0043C0',
            'rgb'     => '0,67,192',
            'logo'    => '/images/partners/panasonic.svg',
            'jurusan' => 'Teknik Pendingin & Tata Udara (TPTUP)',
            'bentuk'  => 'Mitra Teknologi Refrigerasi Komersial',
            'slug'    => 'teknik-pendingin-dan-tata-udara',
            'detail'  => 'Pemberian materi kejuruan tata udara ramah lingkungan serta pelatihan perbaikan sistem refrigerasi hemat energi.',
        ],
        'apitu' => [
            'name'    => 'APITU Bali',
            'role'    => 'Asosiasi Praktisi Tata Udara',
            'color'   => '#0284C7',
            'rgb'     => '2,132,199',
            'logo'    => '/images/partners/apitu.svg',
            'jurusan' => 'Teknik Pendingin & Tata Udara (TPTUP)',
            'bentuk'  => 'Asosiasi Profesi & Sertifikasi Teknisi',
            'slug'    => 'teknik-pendingin-dan-tata-udara',
            'detail'  => 'Asosiasi resmi teknisi pendingin di Bali yang menjadi mitra penguji eksternal Uji Kompetensi Keahlian (UKK) jurusan TPTUP.',
        ],
        'iai_bali' => [
            'name'    => 'IAI Daerah Bali',
            'role'    => 'Ikatan Arsitek Indonesia',
            'color'   => '#475569',
            'rgb'     => '71,85,105',
            'logo'    => '/images/partners/iai_bali.svg',
            'jurusan' => 'Desain Pemodelan Bangunan (DPIB)',
            'bentuk'  => 'Asosiasi Perencana Arsitektur',
            'slug'    => 'desain-pemodelan-dan-informasi-bangunan',
            'detail'  => 'Pendampingan standar gambar arsitektur vernakular Bali dan asistensi penyusunan dokumen tender proyek gedung.',
        ],
        'bkk_disnaker' => [
            'name'    => 'BKK Disnaker',
            'role'    => 'Bursa Kerja & Penyaluran',
            'color'   => '#0E1133',
            'rgb'     => '14,17,51',
            'logo'    => '/images/partners/bkk_disnaker.svg',
            'jurusan' => 'Semua Konsentrasi Keahlian (13 Jurusan)',
            'bentuk'  => 'Pusat Penyaluran Karir & Job Fair',
            'slug'    => 'profil',
            'detail'  => 'Unit Bursa Kerja Khusus (BKK) SMK Negeri 1 Denpasar di bawah binaan Disnaker Kota Denpasar dan Provinsi Bali untuk rekrutmen alumni.',
        ],
    ];

    // 4 Columns: outer = visible on mobile/desktop; inner = visible on xl desktop only.
    // speed = px/sec upward, depth = mouse tilt strength, offset = initial phase (0..1).
    $partnerColumns = [
        ['id' => 'left-outer',  'pos' => 'left-[1%] sm:left-[1.5%]',       'vis' => 'flex',           'speed' => 34, 'depth' => 20,  'offset' => 0.00, 'items' => ['daikin', 'honda', 'toyota', 'telkom', 'pln', 'yamaha']],
        ['id' => 'left-inner',  'pos' => 'left-[16%] 2xl:left-[17%]',     'vis' => 'hidden xl:flex', 'speed' => 24, 'depth' => 12,  'offset' => 0.52, 'items' => ['nissan', 'jinom', 'nevelop', 'imaji', 'schneider', 'casa_amertha']],
        ['id' => 'right-inner', 'pos' => 'right-[16%] 2xl:right-[17%]',    'vis' => 'hidden xl:flex', 'speed' => 28, 'depth' => -12, 'offset' => 0.28, 'items' => ['komatsu', 'damar_bumi', 'arta_yasa', 'bnsp_lsp', 'united_tractors', 'taksu_tech']],
        ['id' => 'right-outer', 'pos' => 'right-[1%] sm:right-[1.5%]',      'vis' => 'flex',           'speed' => 38, 'depth' => -20, 'offset' => 0.74, 'items' => ['bamboomedia', 'biznet', 'panasonic', 'apitu', 'iai_bali', 'bkk_disnaker']],
    ];
@endphp

{{-- Infinite Vertical Flow Columns Container --}}
<div id="partner-cards-container"
     class="absolute inset-0 w-full max-w-[1440px] mx-auto pointer-events-none [mask-image:linear-gradient(to_bottom,transparent_0%,#000_12%,#000_88%,transparent_100%)] select-none">
    @foreach ($partnerColumns as $col)
        <div class="partner-flow-column absolute top-0 bottom-0 {{ $col['pos'] }} {{ $col['vis'] }} w-11 sm:w-12 lg:w-[165px] 2xl:w-[180px] will-change-transform"
             data-column="{{ $col['id'] }}" data-speed="{{ $col['speed'] }}" data-depth="{{ $col['depth'] }}" data-offset="{{ $col['offset'] }}">
            @foreach ($col['items'] as $key)
                @php $p = $flowPartners[$key]; @endphp
                <div class="partner-flow-card absolute left-0 top-0 w-full pointer-events-auto will-change-transform" data-partner-key="{{ $key }}">
                    <button type="button"
                            data-partner-btn
                            data-partner-name="{{ $p['name'] }}"
                            data-partner-logo="{{ $p['logo'] }}"
                            data-partner-jurusan="{{ $p['jurusan'] }}"
                            data-partner-bentuk="{{ $p['bentuk'] }}"
                            data-partner-detail="{{ $p['detail'] }}"
                            data-partner-slug="{{ $p['slug'] }}"
                            aria-haspopup="dialog"
                            aria-label="Lihat rincian kemitraan {{ $p['name'] }}"
                            style="--brand: {{ $p['color'] }}; --brand-rgb: {{ $p['rgb'] }};"
                            class="partner-compact-orb group w-11 sm:w-12 lg:w-full flex items-center justify-center lg:justify-start gap-2 lg:gap-3 p-1 sm:p-1.5 lg:p-2.5 rounded-2xl bg-white/95 border-2 border-ink shadow-sm backdrop-blur-md cursor-pointer transition-all duration-300 hover:scale-[1.05] hover:border-[var(--brand)] hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-navy">
                        <span class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-xl bg-paper border border-line/70 p-1 flex items-center justify-center shrink-0 overflow-hidden transition-all duration-300 group-hover:border-ink">
                            <img src="{{ $p['logo'] }}" alt="Logo {{ $p['name'] }}" class="max-h-4 sm:max-h-5 lg:max-h-6 max-w-[26px] sm:max-w-[30px] lg:max-w-[38px] w-auto h-auto object-contain pointer-events-none" loading="lazy" />
                        </span>
                        <span class="hidden lg:block text-left min-w-0 pr-1">
                            <span class="block text-xs font-display font-extrabold text-ink group-hover:text-navy truncate leading-tight">{{ $p['name'] }}</span>
                            <span class="block text-[10px] font-semibold text-ink-muted truncate mt-0.5">{!! $p['role'] !!}</span>
                        </span>
                    </button>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
