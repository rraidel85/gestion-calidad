<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\File;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFilesTest extends TestCase
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
    public function it_gets_user_files()
    {
        $user = User::factory()->create();
        $files = File::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.files.index', $user));

        $response->assertOk()->assertSee($files[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_files()
    {
        $user = User::factory()->create();
        $data = File::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.files.store', $user),
            $data
        );

        $this->assertDatabaseHas('files', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $file = File::latest('id')->first();

        $this->assertEquals($user->id, $file->user_id);
    }
}
