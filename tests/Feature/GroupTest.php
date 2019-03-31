<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreTest()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $response = $this->post('/group',[
            'name' => 'rust'
        ]);
        $response->assertStatus(302);

        $this->assertDatabaseHas('groups', [
            'name' => 'rust'
        ]);
    }
}