<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TypeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeAreaControllerTest extends TestCase
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
    public function it_displays_index_view_with_type_areas()
    {
        $typeAreas = TypeArea::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('type-areas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.type_areas.index')
            ->assertViewHas('typeAreas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_type_area()
    {
        $response = $this->get(route('type-areas.create'));

        $response->assertOk()->assertViewIs('app.type_areas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_type_area()
    {
        $data = TypeArea::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('type-areas.store'), $data);

        $this->assertDatabaseHas('type_areas', $data);

        $typeArea = TypeArea::latest('id')->first();

        $response->assertRedirect(route('type-areas.edit', $typeArea));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_type_area()
    {
        $typeArea = TypeArea::factory()->create();

        $response = $this->get(route('type-areas.show', $typeArea));

        $response
            ->assertOk()
            ->assertViewIs('app.type_areas.show')
            ->assertViewHas('typeArea');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_type_area()
    {
        $typeArea = TypeArea::factory()->create();

        $response = $this->get(route('type-areas.edit', $typeArea));

        $response
            ->assertOk()
            ->assertViewIs('app.type_areas.edit')
            ->assertViewHas('typeArea');
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

        $response = $this->put(route('type-areas.update', $typeArea), $data);

        $data['id'] = $typeArea->id;

        $this->assertDatabaseHas('type_areas', $data);

        $response->assertRedirect(route('type-areas.edit', $typeArea));
    }

    /**
     * @test
     */
    public function it_deletes_the_type_area()
    {
        $typeArea = TypeArea::factory()->create();

        $response = $this->delete(route('type-areas.destroy', $typeArea));

        $response->assertRedirect(route('type-areas.index'));

        $this->assertDeleted($typeArea);
    }
}
