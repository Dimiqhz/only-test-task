<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'name'   => $this->faker->name(),
            'phone'  => $this->faker->phoneNumber(),
            'car_id' => Car::factory(),
        ];
    }
}
