@extends('layouts.public')

@section('title', 'Hubungi Kami & Layanan Humas - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-[#EAEDFF] text-[#2B4EFF] text-xs font-extrabold uppercase tracking-widest">
                Layanan Informasi Publik & Kemitraan DUDI
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Hubungi SMK Negeri 1 Denpasar</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Sampaikan pertanyaan seputar PPDB, kerja sama industri (PKL & rekrutmen BKK), legalisir dokumen, atau kunjungan studi ke sekolah SKENSA.
            </p>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Contact Info --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-4">
                    <h2 class="font-display font-bold text-xl text-ink">Identitas & Koordinat Sekolah</h2>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Alamat Lengkap & Kode Pos</span>
                        <p class="text-sm text-ink-muted mt-1 leading-relaxed">
                            {{ $settings['school_address'] ?? 'Jalan HOS. Cokroaminoto No. 84, Ubung, Kec. Denpasar Utara, Kota Denpasar, Bali 80118' }}
                        </p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Telepon / WhatsApp Humas</span>
                        <p class="text-sm font-semibold text-ink mt-1 tabular-nums">{{ $settings['school_phone'] ?? '081236396662' }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Surel Resmi</span>
                        <p class="text-sm font-semibold text-ink mt-1">{{ $settings['school_email'] ?? 'fo@smkn1denpasar.sch.id' }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Jam Layanan Tata Usaha</span>
                        <p class="text-sm text-ink-muted mt-1">Senin s.d. Jumat: 07.30 - 15.30 WITA</p>
                    </div>
                </div>

                {{-- Interactive Google Maps Embed Card --}}
                <div class="rounded-2xl bg-navy text-paper border border-line overflow-hidden">
                    <div class="p-5 border-b border-navy-700 flex items-center justify-between gap-3">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#2B4EFF]">Peta Lokasi Interaktif</span>
                            <h3 class="font-display font-bold text-base mt-0.5">Gedung Utama Jalan HOS. Cokroaminoto No. 84</h3>
                        </div>
                        <a
                            href="https://maps.google.com/?q=SMK+Negeri+1+Denpasar"
                            target="_blank"
                            rel="noopener"
                            class="px-3 py-1.5 rounded-lg bg-[#2B4EFF] text-white text-xs font-extrabold uppercase tracking-wider shrink-0 hover:bg-[#1E3FE0]"
                        >
                            Rute &nearr;
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

            {{-- Contact Form --}}
            <div class="lg:col-span-7">
                <form method="POST" action="{{ route('contact.store') }}" class="p-8 rounded-2xl bg-paper-2/80 border-2 border-ink space-y-5">
                    @csrf
                    <h2 class="font-display font-extrabold text-2xl text-ink">Kirim Pesan Resmi ke Humas SKENSA</h2>

                    @if($errors->any())
                        <div class="p-4 rounded-xl bg-alert-skensa/10 border border-alert-skensa text-alert-skensa text-xs font-semibold">
                            Mohon periksa kembali isian formulir Anda. Pastikan seluruh kolom wajib telah terisi dengan benar.
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
                                placeholder="Nama lengkap Anda"
                            >
                            @error('name') <span class="text-xs text-alert-skensa mt-1 block">{{ $message }}</span> @enderror
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
                                placeholder="nama@instansi.id"
                            >
                            @error('email') <span class="text-xs text-alert-skensa mt-1 block">{{ $message }}</span> @enderror
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
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                                placeholder="0812xxxxxxxx"
                            >
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Perihal / Subjek *</label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                required
                                class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                                placeholder="Kemitraan Industri / Informasi PPDB"
                            >
                            @error('subject') <span class="text-xs text-alert-skensa mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-ink mb-1.5">Isi Pesan Lengkap *</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-paper border border-line text-sm text-ink focus:outline-none focus:border-navy"
                            placeholder="Tuliskan pesan atau keperluan Anda secara rinci..."
                        >{{ old('message') }}</textarea>
                        @error('message') <span class="text-xs text-alert-skensa mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button
                        type="submit"
                        class="px-6 py-3.5 rounded-xl bg-navy text-paper font-bold text-xs uppercase tracking-wider hover:bg-navy-700 transition-colors cursor-pointer"
                    >
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
