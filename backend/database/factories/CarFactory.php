<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        $letters = 'ABEKMHOPCTYX';
        $plate = sprintf(
            '%s%03d%s%02d',
            $this->faker->randomElement(str_split($letters)),
            $this->faker->numberBetween(1, 999),
            $this->faker->randomElement(str_split($letters)) .
            $this->faker->randomElement(str_split($letters)),
            $this->faker->numberBetween(1, 99)
        );

        return [
            'car_model_id'  => CarModel::factory(),
            'license_plate' => $plate,
            'vin'           => strtoupper($this->faker->bothify(str_repeat('#', 17))),
        ];
    }
}
