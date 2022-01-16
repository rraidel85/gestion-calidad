<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\File;

use App\Models\Area;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
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
    public function it_gets_files_list()
    {
        $files = File::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.files.index'));

        $response->assertOk()->assertSee($files[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_file()
    {
        $data = File::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.files.store'), $data);

        $this->assertDatabaseHas('files', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_file()
    {
        $file = File::factory()->create();

        $area = Area::factory()->create();
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'area_id' => $area->id,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ];

        $response = $this->putJson(route('api.files.update', $file), $data);

        $data['id'] = $file->id;

        $this->assertDatabaseHas('files', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_file()
    {
        $file = File::factory()->create();

        $response = $this->deleteJson(route('api.files.destroy', $file));

        $this->assertDeleted($file);

        $response->assertNoContent();
    }
}
