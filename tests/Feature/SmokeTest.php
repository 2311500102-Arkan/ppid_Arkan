<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Page;
use App\Models\Post;

class SmokeTest extends TestCase
{
    public function test_home_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('PPID Arkan');
    }

    public function test_berita_page_loads()
    {
        $response = $this->get('/berita');
        $response->assertStatus(200);
    }

    public function test_dokumen_page_loads()
    {
        $response = $this->get('/dokumen');
        $response->assertStatus(200);
    }

    public function test_galeri_page_loads()
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
    }

    public function test_kontak_page_loads()
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_permohonan_informasi_page_loads()
    {
        $response = $this->get('/permohonan-informasi');
        $response->assertStatus(200);
    }

    public function test_pengajuan_keberatan_page_loads()
    {
        $response = $this->get('/pengajuan-keberatan');
        $response->assertStatus(200);
    }

    public function test_search_page_loads()
    {
        $response = $this->get('/cari?q=visi');
        $response->assertStatus(200);
    }

    public function test_static_page_loads()
    {
        $page = Page::first();
        if ($page) {
            $response = $this->get('/page/' . $page->slug);
            $response->assertStatus(200);
        }
    }

    public function test_post_detail_page_loads()
    {
        $post = Post::first();
        if ($post) {
            $response = $this->get('/berita/' . $post->slug);
            $response->assertStatus(200);
        }
    }
}
