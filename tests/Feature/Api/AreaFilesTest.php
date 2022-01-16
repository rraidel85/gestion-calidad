<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Area;
use App\Models\File;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaFilesTest extends TestCase
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
    public function it_gets_area_files()
    {
        $area = Area::factory()->create();
        $files = File::factory()
            ->count(2)
            ->create([
                'area_id' => $area->id,
            ]);

        $response = $this->getJson(route('api.areas.files.index', $area));

        $response->assertOk()->assertSee($files[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_area_files()
    {
        $area = Area::factory()->create();
        $data = File::factory()
            ->make([
                'area_id' => $area->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.areas.files.store', $area),
            $data
        );

        $this->assertDatabaseHas('files', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $file = File::latest('id')->first();

        $this->assertEquals($area->id, $file->area_id);
    }
}
