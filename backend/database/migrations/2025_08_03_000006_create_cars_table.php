<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')
                ->constrained('car_models')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('license_plate')->unique()->comment('Номерной знак');
            $table->string('vin')->unique()->comment('VIN автомобиля');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
}
