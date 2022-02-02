<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\TypeArea;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(10),
            'type_area_id' => rand(1, TypeArea::count())
        ];
    }
}
