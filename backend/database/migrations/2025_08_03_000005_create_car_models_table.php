<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название модели автомобиля');
            $table->foreignId('comfort_category_id')
                ->constrained('comfort_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['name','comfort_category_id'], 'model_category_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
}
