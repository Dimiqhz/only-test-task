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

        $categoriesData = [
            ['name' => 'Первая',   'level' => 1],
            ['name' => 'Вторая',   'level' => 2],
            ['name' => 'Третья',   'level' => 3],
            ['name' => 'Четвёртая','level' => 4],
            ['name' => 'Пятая',    'level' => 5],
        ];
        foreach ($categoriesData as $data) {
            ComfortCategory::updateOrCreate(
                ['level' => $data['level']],
                ['name' => $data['name']]
            );
        }

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
