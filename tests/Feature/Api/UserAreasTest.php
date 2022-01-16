<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Area;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAreasTest extends TestCase
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
    public function it_gets_user_areas()
    {
        $user = User::factory()->create();
        $area = Area::factory()->create();

        $user->areas()->attach($area);

        $response = $this->getJson(route('api.users.areas.index', $user));

        $response->assertOk()->assertSee($area->name);
    }

    /**
     * @test
     */
    public function it_can_attach_areas_to_user()
    {
        $user = User::factory()->create();
        $area = Area::factory()->create();

        $response = $this->postJson(
            route('api.users.areas.store', [$user, $area])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->areas()
                ->where('areas.id', $area->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_areas_from_user()
    {
        $user = User::factory()->create();
        $area = Area::factory()->create();

        $response = $this->deleteJson(
            route('api.users.areas.store', [$user, $area])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->areas()
                ->where('areas.id', $area->id)
                ->exists()
        );
    }
}
