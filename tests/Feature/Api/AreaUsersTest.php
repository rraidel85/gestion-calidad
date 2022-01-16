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
        $users = User::factory()
            ->count(2)
            ->create([
                'area_id' => $area->id,
            ]);

        $response = $this->getJson(route('api.areas.users.index', $area));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_area_users()
    {
        $area = Area::factory()->create();
        $data = User::factory()
            ->make([
                'area_id' => $area->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.areas.users.store', $area),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['area_id']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($area->id, $user->area_id);
    }
}
