<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComfortCategoryFactory extends Factory
{
    protected $model = ComfortCategory::class;

    public function definition(): array
    {
        $level = $this->faker->numberBetween(1, 5);
        return [
            'name'  => match($level) {
                1 => 'Первая', 2 => 'Вторая', 3 => 'Третья',
                4 => 'Четвёртая', default => 'Пятая'
            },
            'level' => $level,
        ];
    }
}
