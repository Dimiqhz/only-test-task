<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    protected $model = CarModel::class;

    public function definition(): array
    {
        return [
            'name'                 => $this->faker->unique()->words(2, true),
            'comfort_category_id'  => ComfortCategory::factory(),
        ];
    }
}
