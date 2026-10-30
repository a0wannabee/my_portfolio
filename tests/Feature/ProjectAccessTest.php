<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/post/projects')->assertRedirect('/login');
    }

    public function test_non_admin_gets_forbidden(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/post/projects')->assertForbidden();
    }

    public function test_admin_can_open_projects(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/post/projects')->assertOk();
    }

    public function test_register_is_closed(): void
    {
        $this->get('/register')->assertNotFound();
    }
}
