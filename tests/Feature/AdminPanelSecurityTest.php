<?php

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Enums\UserStatus;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminPanelSecurityTest extends TestCase
{
    use DatabaseTransactions;

    protected User $admin;
    protected User $guruRpl;
    protected User $siswaRama;
    protected Major $rplMajor;
    protected Classroom $rplClassroom;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rplMajor = Major::firstOrCreate(
            ['code' => 'RPL'],
            ['name' => 'Rekayasa Perangkat Lunak', 'slug' => 'rekayasa-perangkat-lunak', 'order_index' => 1]
        );

        $this->rplClassroom = Classroom::firstOrCreate(
            ['name' => 'XII RPL 1'],
            ['major_id' => $this->rplMajor->id, 'grade_level' => 12]
        );

        $this->admin = User::updateOrCreate(
            ['username' => 'admin_test_sec'],
            [
                'name' => 'Admin Security Tester',
                'email' => 'admin_test_sec@smkn1denpasar.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => UserStatus::Active,
                'two_factor_secret' => 'JBSWY3DPEHPK3PXP',
                'two_factor_confirmed_at' => now(),
            ]
        );

        $this->guruRpl = User::firstOrCreate(
            ['username' => 'guru_rpl_test_sec'],
            [
                'name' => 'Guru RPL Tester',
                'email' => 'guru_rpl_test_sec@smkn1denpasar.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'status' => UserStatus::Active,
                'major_id' => $this->rplMajor->id,
            ]
        );

        $this->siswaRama = User::firstOrCreate(
            ['username' => 'siswa_test_rama_sec'],
            [
                'name' => 'Rama Siswa Test',
                'email' => 'rama_test_sec@siswa.skensa.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'status' => UserStatus::Active,
                'major_id' => $this->rplMajor->id,
            ]
        );
    }

    public function test_security_headers_are_attached_globally(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_login_anti_enumeration_returns_generic_error(): void
    {
        $response = $this->post('/login', [
            'username' => 'non_existing_user_xyz',
            'password' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors('username');
        $this->assertStringContainsString('tidak sesuai', session('errors')->first('username'));
    }

    public function test_student_self_registration_creates_pending_account(): void
    {
        $uniqueNis = '88' . rand(1000, 9999);
        $response = $this->post('/daftar', [
            'name' => 'Siswa Baru ' . $uniqueNis,
            'nis' => $uniqueNis,
            'email' => "siswa{$uniqueNis}@test.com",
            'major_id' => $this->rplMajor->id,
            'classroom_id' => $this->rplClassroom->id,
            'password' => 'SiswaKuat123',
            'password_confirmation' => 'SiswaKuat123',
        ]);

        $response->assertRedirect('/login');

        $user = User::where('username', $uniqueNis)->first();
        $this->assertNotNull($user);
        $this->assertEquals(UserStatus::Pending, $user->status);
        $this->assertTrue($user->isSiswa());

        // Verify pending user cannot log in
        $loginAttempt = $this->post('/login', [
            'username' => $uniqueNis,
            'password' => 'SiswaKuat123',
        ]);
        $loginAttempt->assertSessionHasErrors('username');
        $this->assertStringContainsString('Menunggu Verifikasi Aktivasi', session('errors')->first('username'));
    }

    public function test_guru_can_activate_pending_student_in_their_major(): void
    {
        $uniqueNis = '77' . rand(1000, 9999);
        $pendingStudent = User::create([
            'name' => 'Pending Student In RPL',
            'username' => $uniqueNis,
            'email' => "pending{$uniqueNis}@test.com",
            'password' => Hash::make('password123'),
            'role' => 'siswa',
            'status' => UserStatus::Pending,
            'major_id' => $this->rplMajor->id,
        ]);

        $response = $this->actingAs($this->guruRpl)->post("/admin/users/{$pendingStudent->id}/activate");
        $response->assertSessionHas('status');

        $pendingStudent->refresh();
        $this->assertEquals(UserStatus::Active, $pendingStudent->status);
        $this->assertEquals($this->guruRpl->id, $pendingStudent->activated_by);
    }

    public function test_student_post_starts_as_pending_and_requires_approval(): void
    {
        $uniqueTitle = 'Inovasi Aplikasi Mobile oleh Siswa RPL ' . Str::random(6);
        $response = $this->actingAs($this->siswaRama)->post('/admin/posts', [
            'title' => $uniqueTitle,
            'category' => 'berita',
            'content' => '<p>Konten berita karya siswa untuk pengujian alur persetujuan lengkap dan komprehensif.</p>',
            'excerpt' => 'Ringkasan inovasi siswa.',
        ]);

        $response->assertRedirect('/admin/posts');

        $post = Post::where('title', $uniqueTitle)->first();
        $this->assertNotNull($post);
        $this->assertEquals(PostStatus::Pending, $post->status);
        $this->assertEquals($this->rplMajor->id, $post->major_id);

        // Verify it is NOT visible on public publications page
        $publicResponse = $this->get('/publikasi');
        $publicResponse->assertDontSee($uniqueTitle);

        // Guru approves the post
        $approveResponse = $this->actingAs($this->guruRpl)->post("/admin/review/{$post->id}/approve");
        $approveResponse->assertRedirect('/admin/review');

        $post->refresh();
        $this->assertEquals(PostStatus::Published, $post->status);
        $this->assertEquals($this->guruRpl->id, $post->reviewed_by);

        // Now verify it IS visible on public publications page
        $publicResponseAfter = $this->get('/publikasi');
        $publicResponseAfter->assertSee($uniqueTitle);
    }

    public function test_rejected_post_resubmits_to_pending_when_student_updates_it(): void
    {
        $uniqueSlug = 'artikel-revisi-' . Str::random(8);
        $post = Post::create([
            'title' => 'Artikel Butuh Revisi Siswa ' . Str::random(4),
            'slug' => $uniqueSlug,
            'category' => 'berita',
            'content' => '<p>Teks awal yang kurang lengkap untuk ditinjau oleh guru kejuruan.</p>',
            'status' => PostStatus::Pending,
            'major_id' => $this->rplMajor->id,
            'author_id' => $this->siswaRama->id,
        ]);

        // Guru rejects with note
        $this->actingAs($this->guruRpl)->post("/admin/review/{$post->id}/reject", [
            'review_note' => 'Mohon tambahkan rincian teknologi yang digunakan.',
        ]);

        $post->refresh();
        $this->assertEquals(PostStatus::Rejected, $post->status);
        $this->assertEquals('Mohon tambahkan rincian teknologi yang digunakan.', $post->review_note);

        // Siswa updates the rejected post
        $updateResponse = $this->actingAs($this->siswaRama)->put("/admin/posts/{$post->id}", [
            'title' => 'Artikel Butuh Revisi Siswa (Sudah Diperbaiki)',
            'category' => 'berita',
            'content' => '<p>Teks revisi lengkap dengan rincian Laravel dan MySQL yang sudah memenuhi kriteria.</p>',
            'excerpt' => 'Ringkasan perbaikan.',
        ]);

        $updateResponse->assertRedirect('/admin/posts');

        $post->refresh();
        $this->assertEquals(PostStatus::Pending, $post->status); // Status automatically reset to pending!
    }

    public function test_server_monitor_endpoint_access_control(): void
    {
        // Siswa cannot access server monitor
        $siswaResponse = $this->actingAs($this->siswaRama)->get('/admin/server');
        $siswaResponse->assertStatus(403);

        $siswaPollResponse = $this->actingAs($this->siswaRama)->getJson('/admin/server/poll');
        $siswaPollResponse->assertStatus(403);

        // Guru cannot access server monitor
        $guruResponse = $this->actingAs($this->guruRpl)->get('/admin/server');
        $guruResponse->assertStatus(403);

        // Admin can access server monitor and poll
        $adminPoll = $this->actingAs($this->admin)->withSession(['two_factor_verified' => true])->getJson('/admin/server/poll');
        $adminPoll->assertStatus(200);
        $adminPoll->assertJsonStructure([
            'cpu_usage',
            'memory' => ['total_mb', 'used_mb', 'free_mb', 'used_percent'],
            'disk' => ['total_gb', 'used_gb', 'free_gb', 'used_percent'],
            'load_average' => ['1m', '5m', '15m'],
            'uptime' => ['seconds', 'human'],
            'services',
            'database' => ['size_mb', 'database_name', 'user'],
            'processes',
        ]);
    }

    public function test_two_factor_setup_does_not_leak_secret_when_already_confirmed(): void
    {
        // Admin already has 2FA confirmed in setUp(); unverified session must be redirected to challenge
        $response = $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => false])
            ->get('/two-factor/setup');

        $response->assertRedirect(route('two-factor.challenge'));
        $response->assertDontSee('SECRET123');

        // Confirm setup POST must also be blocked when 2FA is already enabled
        $postResponse = $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => false])
            ->post('/two-factor/setup', ['code' => '123456']);

        $postResponse->assertRedirect(route('two-factor.challenge'));
    }

    public function test_two_factor_challenge_enforces_rate_limiting(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->actingAs($this->admin)
                ->withSession(['two_factor_verified' => false])
                ->post('/two-factor/challenge', ['code' => '000000']);
        }

        $throttled = $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => false])
            ->post('/two-factor/challenge', ['code' => '000000']);

        $throttled->assertSessionHasErrors('code');
        $this->assertStringContainsString('Terlalu banyak percobaan', session('errors')->first('code'));
    }

    public function test_login_does_not_leak_pending_status_when_password_is_wrong(): void
    {
        $uniqueNis = '66' . rand(1000, 9999);
        User::create([
            'name' => 'Pending Enumeration Test',
            'username' => $uniqueNis,
            'email' => "enum{$uniqueNis}@test.com",
            'password' => Hash::make('CorrectPassword123'),
            'role' => 'siswa',
            'status' => UserStatus::Pending,
            'major_id' => $this->rplMajor->id,
        ]);

        // Wrong password must return generic error, NOT pending status message
        $wrongPassResponse = $this->post('/login', [
            'username' => $uniqueNis,
            'password' => 'WrongPassword999',
        ]);

        $wrongPassResponse->assertSessionHasErrors('username');
        $this->assertStringContainsString('tidak sesuai', session('errors')->first('username'));
        $this->assertStringNotContainsString('Menunggu Verifikasi', session('errors')->first('username'));
    }

    public function test_student_cannot_spoof_another_major_id_or_view_other_major_gallery(): void
    {
        $tkjMajor = Major::firstOrCreate(
            ['code' => 'TKJ'],
            ['name' => 'Teknik Komputer dan Jaringan', 'slug' => 'teknik-komputer-dan-jaringan', 'order_index' => 2]
        );

        $uniqueTitle = 'Berita Coba Spoof Jurusan ' . Str::random(6);
        $this->actingAs($this->siswaRama)->post('/admin/posts', [
            'title' => $uniqueTitle,
            'category' => 'berita',
            'major_id' => $tkjMajor->id, // Attempting to spoof TKJ major while belonging to RPL
            'content' => '<p>Isi berita percobaan penguncian otorisasi jurusan siswa.</p>',
        ])->assertRedirect('/admin/posts');

        $post = Post::where('title', $uniqueTitle)->firstOrFail();
        $this->assertEquals($this->rplMajor->id, $post->major_id);

        // Guru RPL cannot view a TKJ gallery album in panel
        $tkjAlbum = \App\Models\GalleryAlbum::create([
            'title' => 'Album Khusus TKJ',
            'slug' => 'album-khusus-tkj-' . Str::random(5),
            'category' => 'Kegiatan',
            'major_id' => $tkjMajor->id,
            'created_by' => $this->admin->id,
        ]);

        $this->actingAs($this->guruRpl)
            ->get(route('panel.gallery.show', $tkjAlbum))
            ->assertStatus(403);
    }

    public function test_admin_can_view_contact_messages_on_dashboard_and_inbox(): void
    {
        $message = \App\Models\ContactMessage::create([
            'name' => 'Pengirim Uji Coba',
            'email' => 'pengirim@test.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Kemitraan',
            'message' => 'Ini adalah isi pesan percobaan untuk verifikasi panel admin.',
            'is_read' => false,
        ]);

        // Dashboard harus menampilkan widget pesan
        $response = $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => true])
            ->get(route('panel.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Pesan Masuk Humas');
        $response->assertSee('Pengirim Uji Coba');
        $response->assertSee('Pertanyaan Kemitraan');

        // Halaman kotak masuk pesan
        $inboxResponse = $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => true])
            ->get(route('panel.messages.index'));
        $inboxResponse->assertStatus(200);
        $inboxResponse->assertSee('Pengirim Uji Coba');
        $inboxResponse->assertSee('pengirim@test.com');
    }

    public function test_non_admin_cannot_access_panel_messages(): void
    {
        $this->actingAs($this->guruRpl)
            ->withSession(['two_factor_verified' => true])
            ->get(route('panel.messages.index'))
            ->assertStatus(403);

        $this->actingAs($this->siswaRama)
            ->withSession(['two_factor_verified' => true])
            ->get(route('panel.messages.index'))
            ->assertStatus(403);
    }

    public function test_admin_can_mark_message_read_and_unread(): void
    {
        $message = \App\Models\ContactMessage::create([
            'name' => 'Mitra Industri',
            'email' => 'mitra@industri.com',
            'subject' => 'Tawaran Magang Siswa',
            'message' => 'Mohon informasi alur pengajuan MoU kemitraan siswa.',
            'is_read' => false,
        ]);

        // Tandai dibaca
        $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => true])
            ->patch(route('panel.messages.read', $message))
            ->assertRedirect();

        $this->assertTrue($message->fresh()->is_read);

        // Tandai belum dibaca
        $this->actingAs($this->admin)
            ->withSession(['two_factor_verified' => true])
            ->patch(route('panel.messages.unread', $message))
            ->assertRedirect();

        $this->assertFalse($message->fresh()->is_read);
    }
}
