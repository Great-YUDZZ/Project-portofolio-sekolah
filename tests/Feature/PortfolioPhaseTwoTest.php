<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\Major;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PortfolioPhaseTwoTest extends TestCase
{
    use DatabaseTransactions;

    public function test_all_ten_public_portfolio_pages_load_successfully(): void
    {
        $routes = [
            '/',
            '/profil',
            '/sejarah',
            '/visi-misi',
            '/sdm',
            '/jurusan',
            '/karya',
            '/prestasi',
            '/publikasi',
            '/galeri',
            '/kontak',
            '/ekosistem',
            '/ekstrakurikuler',
            '/cari?q=RPL',
        ];

        foreach ($routes as $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200);
        }

        $major = Major::firstOrFail();
        $this->get('/jurusan/' . $major->slug)
            ->assertStatus(200)
            ->assertSee($major->name);

        $post = Post::firstOrFail();
        $this->get('/publikasi/' . $post->slug)
            ->assertStatus(200)
            ->assertSee($post->title);
    }

    public function test_vision_mission_page_loads_with_authentic_data(): void
    {
        $response = $this->get('/visi-misi');
        $response->assertStatus(200);
        $response->assertSee('Terwujudnya sekolah sebagai pusat pendidikan dan pelatihan kejuruan');
        $response->assertSee('Empat Pilar Nilai Karakter');
        $response->assertSee('Siap');
        $response->assertSee('Kompeten');
        $response->assertSee('Disiplin');
        $response->assertSee('Beretika');
        $response->assertSee('BMW');
    }

    public function test_contact_form_submits_and_stores_message(): void
    {
        $response = $this->post('/kontak', [
            'name' => 'I Made Wirawan',
            'email' => 'wirawan@industri.co.id',
            'phone' => '081234567890',
            'subject' => 'Kemitraan PKL Jurusan RPL',
            'message' => 'Kami ingin menjalin kerja sama rekrutmen dan magang siswa jurusan RPL SMKN 1 Denpasar.',
        ]);

        $response->assertRedirect(route('contact.index'));
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'wirawan@industri.co.id',
            'subject' => 'Kemitraan PKL Jurusan RPL',
        ]);
    }

    public function test_extracurriculars_page_loads_with_authentic_data(): void
    {
        $this->get('/ekstra')
            ->assertRedirect(route('extracurriculars.index'));

        $response = $this->get('/ekstrakurikuler');
        $response->assertStatus(200);
        $response->assertSee('Direktori Ekstrakurikuler SKENSA');
        $response->assertSee('Atletik');
        $response->assertSee('Robotik');
        $response->assertSee('Paskibraka');

        // Test Category Filter
        $this->get('/ekstrakurikuler?kategori=akademik')
            ->assertStatus(200)
            ->assertSee('Robotik')
            ->assertSee('Tabuh');

        // Test Search Filter
        $this->get('/ekstrakurikuler?q=Robotik')
            ->assertStatus(200)
            ->assertSee('Robotik');
    }

    public function test_admin_can_access_and_manage_portfolio_content(): void
    {
        $admin = User::where('role', Role::Admin)->firstOrFail();
        $admin->forceFill([
            'two_factor_secret' => 'JBSWY3DPEHPK3PXP',
            'two_factor_confirmed_at' => now(),
        ])->save();

        // Without 2FA session verification, legacy admin route must redirect to 2FA challenge
        $this->actingAs($admin)
            ->get(route('admin.content'))
            ->assertRedirect(route('two-factor.challenge'));

        // With 2FA verified in session, admin can access and manage content safely
        $this->actingAs($admin)
            ->withSession(['two_factor_verified' => true])
            ->get(route('admin.content'))
            ->assertStatus(200)
            ->assertSee('Manajemen Konten Portofolio Publik');

        $this->actingAs($admin)
            ->withSession(['two_factor_verified' => true])
            ->post(route('admin.posts.store'), [
                'title' => 'Pengumuman Uji Kompetensi Keahlian 2026',
                'category' => 'pengumuman',
                'excerpt' => 'Jadwal pelaksanaan UKK LSP P1 untuk kelas XII.',
                'body' => '<p>Pelaksanaan UKK dimulai bulan depan.</p><script>alert(1)</script>',
            ])
            ->assertRedirect(route('admin.content', ['tab' => 'posts']));

        $savedPost = Post::where('title', 'Pengumuman Uji Kompetensi Keahlian 2026')->latest('id')->first();
        $this->assertNotNull($savedPost);
        $this->assertStringNotContainsString('<script>', $savedPost->content);
    }
}
