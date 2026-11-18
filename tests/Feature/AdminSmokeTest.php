<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Document;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\InformationRequest;
use App\Models\Objection;
use App\Models\Contact;

class AdminSmokeTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::where('email', 'admin@ppidarkan.go.id')->first();
    }

    public function test_admin_login_page_loads()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('PPID');
    }

    public function test_admin_redirects_unauthenticated_to_login()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_with_valid_credentials()
    {
        $response = $this->post('/admin/login', [
            'email'    => 'admin@ppidarkan.go.id',
            'password' => 'password',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_dashboard_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_admin_posts_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/posts');
        $response->assertStatus(200);
    }

    public function test_admin_posts_create_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/posts/create');
        $response->assertStatus(200);
    }

    public function test_admin_documents_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/documents');
        $response->assertStatus(200);
    }

    public function test_admin_documents_create_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/documents/create');
        $response->assertStatus(200);
    }

    public function test_admin_pages_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/pages');
        $response->assertStatus(200);
    }

    public function test_admin_banners_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/banners');
        $response->assertStatus(200);
    }

    public function test_admin_galleries_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/galleries');
        $response->assertStatus(200);
    }

    public function test_admin_information_requests_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/information-requests');
        $response->assertStatus(200);
    }

    public function test_admin_objections_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/objections');
        $response->assertStatus(200);
    }

    public function test_admin_contacts_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/contacts');
        $response->assertStatus(200);
    }

    public function test_admin_settings_index_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/settings');
        $response->assertStatus(200);
    }

    public function test_admin_profile_edit_loads()
    {
        $response = $this->actingAs($this->admin)->get('/admin/profile');
        $response->assertStatus(200);
    }

    public function test_admin_information_request_show_loads()
    {
        $req = InformationRequest::first();
        if ($req) {
            $response = $this->actingAs($this->admin)->get('/admin/information-requests/' . $req->id);
            $response->assertStatus(200);
        } else {
            $this->assertTrue(true); // skip if no data
        }
    }

    public function test_admin_objection_show_loads()
    {
        $obj = Objection::first();
        if ($obj) {
            $response = $this->actingAs($this->admin)->get('/admin/objections/' . $obj->id);
            $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_admin_contact_show_loads()
    {
        $contact = Contact::first();
        if ($contact) {
            $response = $this->actingAs($this->admin)->get('/admin/contacts/' . $contact->id);
            $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }
    }
}
