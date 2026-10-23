<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 9 Bidang Keahlian
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 13 Konsentrasi Keahlian / Jurusan
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained('fields')->cascadeOnDelete();
            $table->string('name');
            $table->string('code')->unique(); // TKP, DPIB, TAV, ELIN, TITL, TPTUP, TPM, TSM, TKR, TKJ, RPL, DKV, PRF
            $table->string('slug')->unique();
            $table->text('tagline')->nullable();
            $table->longText('description')->nullable();
            $table->text('vision_mission')->nullable();
            $table->json('career_prospects')->nullable(); // prospek kerja lulusan
            $table->json('competencies')->nullable(); // kompetensi yang diajarkan
            $table->string('head_of_major')->nullable(); // kepala jurusan
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // Kelas
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained('majors')->cascadeOnDelete();
            $table->string('name'); // X TKJ 1, XI RPL 2
            $table->integer('grade_level'); // 10, 11, 12
            $table->string('academic_year')->default('2025/2026');
            $table->timestamps();
        });

        // Profil Siswa
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->nullOnDelete();
            $table->string('nis')->unique();
            $table->string('nisn')->nullable();
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // Profil Guru
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('major_id')->nullable()->constrained('majors')->nullOnDelete();
            $table->string('nip')->nullable();
            $table->string('specialization')->nullable();
            $table->string('education')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });

        // Pengaturan Situs (Semboyan, Nilai Karakter, Kontak, Statistik)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group')->default('general'); // general, identity, contact, stats
            $table->timestamps();
        });

        // Berita & Pengumuman
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['berita', 'pengumuman'])->default('berita');
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Agenda / Kalender Sekolah
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->timestamps();
        });

        // Prestasi Siswa & Sekolah
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_or_team');
            $table->foreignId('major_id')->nullable()->constrained('majors')->nullOnDelete();
            $table->string('rank'); // Juara 1, Medali Emas
            $table->string('level'); // Kota, Provinsi, Nasional, Internasional
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Karya Portofolio Siswa
        Schema::create('student_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained('majors')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('student_name');
            $table->year('year');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->string('demo_url')->nullable();
            $table->json('tech_stack')->nullable();
            $table->timestamps();
        });

        // Direktori Guru & Staff
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_title'); // Kepala Sekolah, Waka Kurikulum, Guru Produktif
            $table->string('department')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // Fasilitas Sekolah
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Link Ekosistem (LMS, e-Library, LSP, Tracer)
        Schema::create('ecosystem_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('url');
            $table->string('icon')->nullable();
            $table->string('badge')->nullable(); // Internal, Eksternal
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // Pesan Masuk Formulir Kontak
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('ecosystem_links');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('staff_members');
        Schema::dropIfExists('student_works');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('events');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('teacher_profiles');
        Schema::dropIfExists('student_profiles');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('majors');
        Schema::dropIfExists('fields');
    }
};
