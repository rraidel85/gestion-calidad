<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Area;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaUsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_area_users()
    {
        $area = Area::factory()->create();
        $user = User::factory()->create();

        $area->users()->attach($user);

        $response = $this->getJson(route('api.areas.users.index', $area));

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_area()
    {
        $area = Area::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.areas.users.store', [$area, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $area
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_area()
    {
        $area = Area::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.areas.users.store', [$area, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $area
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
