@extends('layouts.public')

@section('title', 'Hubungi Kami & Layanan Informasi Publik - SMK Negeri 1 Denpasar')

@section('content')

    {{-- Hero Section --}}
    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-reveal>
            <span class="inline-block px-3 py-1 rounded bg-ink text-white text-xs font-extrabold uppercase tracking-widest">
                Layanan Informasi Publik &amp; Kemitraan DUDI
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3 tracking-tight">Hubungi SMK Negeri 1 Denpasar</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2 leading-relaxed">
                Sampaikan pertanyaan seputar penerimaan siswa baru (PPDB), kerja sama industri (PKL &amp; rekrutmen BKK), legalisir dokumen alumni, serta kunjungan studi vokasi ke kampus SKENSA.
            </p>
        </div>
    </section>

    {{-- Main Contact & Form Section --}}
    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- Left Column: Contact Coordinates & Channels --}}
            <div class="lg:col-span-5 space-y-6" data-reveal>

                {{-- Institutional Coordinates Card --}}
                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-5">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Identitas Kampus</span>
                        <h2 class="font-display font-extrabold text-xl text-ink mt-0.5">Alamat &amp; Kontak Resmi</h2>
                    </div>

                    <div class="space-y-4 text-xs">
                        <div>
                            <span class="block font-bold uppercase tracking-wider text-navy">Alamat Lengkap</span>
                            <p class="text-ink text-sm mt-1 leading-relaxed">
                                {{ $settings['school_address'] ?? 'Jalan HOS. Cokroaminoto No. 84, Ubung, Kec. Denpasar Utara, Kota Denpasar, Bali 80118' }}
                            </p>
                            <span class="text-ink-muted text-[11px] block mt-0.5">NPSN: 50103118 | Kode Pos: 80118</span>
                        </div>

                        <div class="pt-3 border-t border-line">
                            <span class="block font-bold uppercase tracking-wider text-navy">Telepon &amp; WhatsApp Humas</span>
                            <p class="text-sm font-semibold text-ink mt-1">
                                <a href="https://wa.me/6281236396662" target="_blank" rel="noopener" class="text-navy hover:underline font-mono">
                                    {{ $settings['school_phone'] ?? '081236396662' }}
                                </a>
                            </p>
                        </div>

                        <div class="pt-3 border-t border-line">
                            <span class="block font-bold uppercase tracking-wider text-navy">Alamat Surel Resmi</span>
                            <p class="text-sm font-semibold text-ink mt-1">
                                <a href="mailto:{{ $settings['school_email'] ?? 'fo@smkn1denpasar.sch.id' }}" class="text-navy hover:underline font-mono">
                                    {{ $settings['school_email'] ?? 'fo@smkn1denpasar.sch.id' }}
                                </a>
                            </p>
                        </div>

                        <div class="pt-3 border-t border-line">
                            <span class="block font-bold uppercase tracking-wider text-navy">Jam Layanan Kantor Tata Usaha</span>
                            <p class="text-sm text-ink-muted mt-1 leading-relaxed">
                                Senin s.d. Jumat: 07.30 - 15.30 WITA<br>
                                <span class="text-[11px] text-ink-muted">(Sabtu, Minggu &amp; Libur Nasional Tutup)</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Direct Department Channels --}}
                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-4">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Kanal Layanan Terarah</span>
                    <h3 class="font-display font-bold text-base text-ink">Pusat Informasi Divisi</h3>

                    <div class="space-y-3 text-xs">
                        <div class="p-3 rounded-xl bg-paper border border-line">
                            <span class="font-bold text-ink block">Humas &amp; Kemitraan Industri (Hubin)</span>
                            <p class="text-ink-muted text-[11px] mt-0.5">Penjajakan MoU, magang kerja (PKL), dan guru tamu industri.</p>
                            <span class="text-[11px] text-navy font-semibold mt-1 block">Surel: humas@smkn1denpasar.sch.id</span>
                        </div>

                        <div class="p-3 rounded-xl bg-paper border border-line">
                            <span class="font-bold text-ink block">Bursa Kerja Khusus (BKK SKENSA)</span>
                            <p class="text-ink-muted text-[11px] mt-0.5">Perekrutan lulusan, pameran bursa kerja, dan verifikasi alumni.</p>
                            <span class="text-[11px] text-navy font-semibold mt-1 block">Surel: bkk@smkn1denpasar.sch.id</span>
                        </div>

                        <div class="p-3 rounded-xl bg-paper border border-line">
                            <span class="font-bold text-ink block">Layanan Legalisir Ijazah &amp; Dokumen</span>
                            <p class="text-ink-muted text-[11px] mt-0.5">Pelayanan legalisir ijazah, transkrip nilai, dan surat keterangan alumni.</p>
                            <span class="text-[11px] text-navy font-semibold mt-1 block">Loket Tata Usaha Gedung A Lantai 1</span>
                        </div>
                    </div>
                </div>

                {{-- Interactive Map Embed --}}
                <div class="rounded-2xl bg-navy text-paper border border-line overflow-hidden shadow-xs">
                    <div class="p-5 border-b border-navy-700 flex items-center justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-paper/70">Peta Navigasi Kampus</span>
                            <h3 class="font-display font-bold text-base mt-0.5">Jalan HOS. Cokroaminoto No. 84</h3>
                        </div>
                        <a
                            href="https://maps.google.com/?q=SMK+Negeri+1+Denpasar"
                            target="_blank"
                            rel="noopener"
                            class="px-3 py-1.5 rounded-lg bg-ink text-white text-xs font-extrabold uppercase tracking-wider shrink-0 hover:bg-slate-800 transition-colors shadow-xs"
                        >
                            Buka Rute &nearr;
                        </a>
                    </div>
                    <iframe
                        title="Peta Lokasi SMK Negeri 1 Denpasar"
                        src="https://www.google.com/maps?q=SMK+Negeri+1+Denpasar+Jl+HOS+Cokroaminoto+No+84+Denpasar&output=embed"
                        class="w-full h-64 border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>

            </div>

            {{-- Right Column: Contact Message Form --}}
            <div class="lg:col-span-7" data-reveal data-reveal-delay="0.1">
                <form method="POST" action="{{ route('contact.store') }}" class="p-8 rounded-2xl bg-white border-2 border-line space-y-5 shadow-xs">
                    @csrf
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Layanan Respons Publik</span>
                        <h2 class="font-display font-extrabold text-2xl text-ink mt-0.5">Kirim Pesan Resmi ke Humas SKENSA</h2>
                        <p class="text-xs text-ink-muted mt-1 leading-relaxed">
                            Formulir ini diteruskan langsung ke sistem arsip persuratan dan tim Humas SMK Negeri 1 Denpasar. Kami merespons setiap pesan pada hari dan jam kerja operasional.
                        </p>
                    </div>

                    @if($errors->any())
                        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold space-y-1">
                            <span class="font-bold block">Mohon periksa kembali isian formulir Anda:</span>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Nama Lengkap *</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                                placeholder="Contoh: I Putu Widiana"
                            >
                            @error('name') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Alamat Surel (Email) *</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                                placeholder="nama@instansi.com"
                            >
                            @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Nomor Telepon / WhatsApp</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy font-mono"
                                placeholder="08123456789"
                            >
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Perihal / Kategori Pesan *</label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                list="subject-suggestions"
                                value="{{ old('subject') }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                                placeholder="Kemitraan Industri / PPDB / Legalisir"
                            >
                            <datalist id="subject-suggestions">
                                <option value="Kemitraan Industri &amp; MoU (DUDIKA)">
                                <option value="Perekrutan Tenaga Kerja &amp; Lowongan BKK">
                                <option value="Informasi Penerimaan Siswa Baru (PPDB)">
                                <option value="Legalisir Ijazah &amp; Dokumen Akademik Alumni">
                                <option value="Permohonan Kunjungan Studi / Benchmarking">
                                <option value="Pertanyaan Seputar Sertifikasi LSP-P1">
                            </datalist>
                            @error('subject') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Isi Pesan Lengkap *</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                            placeholder="Tuliskan secara terperinci maksud dan keperluan Anda..."
                        >{{ old('message') }}</textarea>
                        @error('message') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <button
                            type="submit"
                            class="w-full sm:w-auto px-6 py-3 rounded-xl bg-navy text-paper font-bold text-xs uppercase tracking-wider hover:bg-navy-700 transition-colors cursor-pointer shadow-xs"
                        >
                            Kirim Pesan Resmi &rarr;
                        </button>
                        <span class="text-[11px] text-ink-muted">
                            Data pribadi dilindungi sesuai UU Pelindungan Data Pribadi.
                        </span>
                    </div>
                </form>
            </div>

        </div>

        {{-- Frequently Asked Questions (FAQ) Section --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 pt-12 border-t border-line" data-reveal>
            <div class="max-w-3xl mb-8">
                <span class="text-xs font-extrabold uppercase tracking-widest text-navy">Pertanyaan Umum</span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-ink mt-1">Tanya Jawab Seputar Layanan SKENSA</h2>
                <p class="text-xs text-ink-muted mt-1 leading-relaxed">
                    Jawaban ringkas atas pertanyaan yang paling sering diajukan masyarakat, mitra industri, dan alumni.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-reveal-stagger>
                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-2">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-navy">Kemitraan Industri &amp; PKL</span>
                    <h3 class="font-display font-bold text-base text-ink">Bagaimana prosedur kerja sama industri (MoU / PKL)?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        Perusahaan atau instansi dapat mengirimkan surat permohonan kemitraan melalui surel resmi humas@smkn1denpasar.sch.id atau langsung ke bagian Hubungan Industri untuk penjadwalan audiensi dan penyusunan naskah kesepakatan bersama (MoU).
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-2">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-navy">Layanan Alumni</span>
                    <h3 class="font-display font-bold text-base text-ink">Bagaimana alur permohonan legalisir ijazah dan transkrip?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        Alumni dapat membawa fotokopi ijazah beserta dokumen asli ke loket pelayanan Tata Usaha pada hari kerja (07.30 - 15.00 WITA). Proses verifikasi dan tanda tangan Kepala Sekolah memerlukan waktu 1 hingga 2 hari kerja tanpa dipungut biaya.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-2">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-navy">Penerimaan Siswa (PPDB)</span>
                    <h3 class="font-display font-bold text-base text-ink">Kapan pendaftaran PPDB dibuka dan apa saja jalurnya?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        PPDB SMK Negeri 1 Denpasar diselenggarakan setiap pertengahan tahun sesuai kalender Disdikpora Provinsi Bali melalui jalur Afirmasi, Sertifikat Prestasi, dan Zonasi/Rangking Nilai Rapor. Informasi pembukaan diumumkan melalui portal publikasi sekolah.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-2">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-navy">Bursa Kerja Khusus (BKK)</span>
                    <h3 class="font-display font-bold text-base text-ink">Bagaimana perusahaan dapat memasang lowongan kerja di BKK?</h3>
                    <p class="text-xs text-ink-muted leading-relaxed">
                        Perusahaan mitra dapat mengirimkan flyer rekrutmen dan kualifikasi ke kontak bkk@smkn1denpasar.sch.id. Tim BKK akan memverifikasi dan menyebarluaskan info lowongan ke jaringan alumni dan portal Tracer Vokasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
