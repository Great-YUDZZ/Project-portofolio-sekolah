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
            '/sdm',
            '/jurusan',
            '/karya',
            '/prestasi',
            '/publikasi',
            '/galeri',
            '/kontak',
            '/ekosistem',
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

    public function test_admin_can_access_and_manage_portfolio_content(): void
    {
        $admin = User::where('role', Role::Admin)->firstOrFail();

        $this->actingAs($admin)
            ->get(route('admin.content'))
            ->assertStatus(200)
            ->assertSee('Manajemen Konten Portofolio Publik');

        $this->actingAs($admin)
            ->post(route('admin.posts.store'), [
                'title' => 'Pengumuman Uji Kompetensi Keahlian 2026',
                'category' => 'pengumuman',
                'excerpt' => 'Jadwal pelaksanaan UKK LSP P1 untuk kelas XII.',
                'body' => 'Pelaksanaan UKK dimulai bulan depan di masing-masing TUK jurusan.',
            ])
            ->assertRedirect(route('admin.content', ['tab' => 'posts']));

        $this->assertDatabaseHas('posts', [
            'title' => 'Pengumuman Uji Kompetensi Keahlian 2026',
        ]);
    }
}
