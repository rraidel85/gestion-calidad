<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\File;

use App\Models\Area;
use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_files()
    {
        $files = File::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('files.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.files.index')
            ->assertViewHas('files');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_file()
    {
        $response = $this->get(route('files.create'));

        $response->assertOk()->assertViewIs('app.files.create');
    }

    /**
     * @test
     */
    public function it_stores_the_file()
    {
        $data = File::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('files.store'), $data);

        $this->assertDatabaseHas('files', $data);

        $file = File::latest('id')->first();

        $response->assertRedirect(route('files.edit', $file));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_file()
    {
        $file = File::factory()->create();

        $response = $this->get(route('files.show', $file));

        $response
            ->assertOk()
            ->assertViewIs('app.files.show')
            ->assertViewHas('file');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_file()
    {
        $file = File::factory()->create();

        $response = $this->get(route('files.edit', $file));

        $response
            ->assertOk()
            ->assertViewIs('app.files.edit')
            ->assertViewHas('file');
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
            'access_level' => $this->faker->randomNumber(0),
            'area_id' => $area->id,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ];

        $response = $this->put(route('files.update', $file), $data);

        $data['id'] = $file->id;

        $this->assertDatabaseHas('files', $data);

        $response->assertRedirect(route('files.edit', $file));
    }

    /**
     * @test
     */
    public function it_deletes_the_file()
    {
        $file = File::factory()->create();

        $response = $this->delete(route('files.destroy', $file));

        $response->assertRedirect(route('files.index'));

        $this->assertDeleted($file);
    }
}
