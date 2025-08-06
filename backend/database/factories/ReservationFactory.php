<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $end   = (clone $start)->modify('+'. $this->faker->numberBetween(1, 5) .' hours');

        return [
            'user_id'  => User::inRandomOrder()->first()->id,
            'car_id'   => Car::inRandomOrder()->first()->id,
            'start_at' => Carbon::instance($start),
            'end_at'   => Carbon::instance($end),
        ];
    }
}
