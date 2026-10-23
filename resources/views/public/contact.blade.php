@extends('layouts.public')

@section('title', 'Hubungi Kami & Layanan Humas - SMK Negeri 1 Denpasar')

@section('content')

    <section class="bg-navy text-paper border-b-2 border-ink py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3 py-1 rounded bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-widest">
                Layanan Informasi Publik & Kemitraan DUDI
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl mt-3">Hubungi SMK Negeri 1 Denpasar</h1>
            <p class="text-paper/80 text-base max-w-3xl mt-2">
                Sampaikan pertanyaan seputar PPDB, kerja sama industri (PKL & rekrutmen BKK), legalisir dokumen, atau kunjungan studi ke kampus SKENSA.
            </p>
        </div>
    </section>

    <section class="py-14 bg-paper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Contact Info --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="p-6 rounded-2xl bg-paper-2 border border-line space-y-4">
                    <h2 class="font-display font-bold text-xl text-ink">Identitas & Koordinat Kampus</h2>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Alamat Lengkap</span>
                        <p class="text-sm text-ink-muted mt-1 leading-relaxed">
                            {{ $settings['school_address'] ?? 'Jalan HOS Cokroaminoto No. 84, Denpasar Utara, Kota Denpasar, Bali 80116' }}
                        </p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Telepon / WhatsApp Humas</span>
                        <p class="text-sm font-semibold text-ink mt-1">{{ $settings['school_phone'] ?? '081 339 276 998' }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Surel Resmi</span>
                        <p class="text-sm font-semibold text-ink mt-1">{{ $settings['school_email'] ?? 'contact@smkn1denpasar.sch.id' }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-navy">Jam Layanan Tata Usaha</span>
                        <p class="text-sm text-ink-muted mt-1">Senin s.d. Jumat: 07.30 - 15.30 WITA</p>
                    </div>
                </div>

                {{-- OpenStreetMap / Location Card --}}
                <div class="p-6 rounded-2xl bg-navy text-paper border-2 border-ink">
                    <span class="text-xs font-bold uppercase tracking-widest text-yellow-skensa">Titik Lokasi Denpasar Utara</span>
                    <h3 class="font-display font-bold text-lg mt-1">Kampus Jalan HOS Cokroaminoto No. 84</h3>
                    <p class="text-xs text-paper/80 mt-2 leading-relaxed">
                        Terletak di jalur utama Denpasar Utara, mudah diakses melalui koridor Trans Metro Dewata (Halte SMKN 1 Denpasar).
                    </p>
                    <a
                        href="https://maps.google.com/?q=SMK+Negeri+1+Denpasar"
                        target="_blank"
                        rel="noopener"
                        class="inline-block mt-4 px-4 py-2 rounded-lg bg-yellow-skensa text-ink text-xs font-extrabold uppercase tracking-wider"
                    >
                        Buka di Google Maps &nearr;
                    </a>
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
