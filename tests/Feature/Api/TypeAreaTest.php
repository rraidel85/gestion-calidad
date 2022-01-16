<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TypeArea;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeAreaTest extends TestCase
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
    public function it_gets_type_areas_list()
    {
        $typeAreas = TypeArea::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.type-areas.index'));

        $response->assertOk()->assertSee($typeAreas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_type_area()
    {
        $data = TypeArea::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.type-areas.store'), $data);

        $this->assertDatabaseHas('type_areas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_type_area()
    {
        $typeArea = TypeArea::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->putJson(
            route('api.type-areas.update', $typeArea),
            $data
        );

        $data['id'] = $typeArea->id;

        $this->assertDatabaseHas('type_areas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_type_area()
    {
        $typeArea = TypeArea::factory()->create();

        $response = $this->deleteJson(
            route('api.type-areas.destroy', $typeArea)
        );

        $this->assertDeleted($typeArea);

        $response->assertNoContent();
    }
}
