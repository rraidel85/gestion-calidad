<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Area;
use App\Models\TypeArea;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeAreaAreasTest extends TestCase
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
    public function it_gets_type_area_areas()
    {
        $typeArea = TypeArea::factory()->create();
        $areas = Area::factory()
            ->count(2)
            ->create([
                'type_area_id' => $typeArea->id,
            ]);

        $response = $this->getJson(
            route('api.type-areas.areas.index', $typeArea)
        );

        $response->assertOk()->assertSee($areas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_type_area_areas()
    {
        $typeArea = TypeArea::factory()->create();
        $data = Area::factory()
            ->make([
                'type_area_id' => $typeArea->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.type-areas.areas.store', $typeArea),
            $data
        );

        $this->assertDatabaseHas('areas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $area = Area::latest('id')->first();

        $this->assertEquals($typeArea->id, $area->type_area_id);
    }
}
