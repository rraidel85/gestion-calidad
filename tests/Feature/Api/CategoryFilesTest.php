<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\File;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryFilesTest extends TestCase
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
    public function it_gets_category_files()
    {
        $category = Category::factory()->create();
        $files = File::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.files.index', $category)
        );

        $response->assertOk()->assertSee($files[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_category_files()
    {
        $category = Category::factory()->create();
        $data = File::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.files.store', $category),
            $data
        );

        $this->assertDatabaseHas('files', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $file = File::latest('id')->first();

        $this->assertEquals($category->id, $file->category_id);
    }
}
