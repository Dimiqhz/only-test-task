<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Position,
    ComfortCategory,
    User,
    CarModel,
    Car,
    Driver,
    Reservation
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Position::factory()->count(5)->create();
        ComfortCategory::factory()->count(4)->create();

        Position::all()->each(function (Position $pos) {
            $ids = ComfortCategory::inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id')
                ->toArray();
            $pos->comfortCategories()->sync($ids);
        });

        User::factory()->count(10)->create();

        CarModel::factory()->count(8)->create();
        Car::factory()->count(12)->create()->each(function (Car $car) {
            Driver::factory()->create(['car_id' => $car->id]);
        });

        Reservation::factory()->count(20)->create();
    }
}
