<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Имя водителя');
            $table->string('phone')->nullable()->comment('Телефон для связи');
            $table->foreignId('car_id')
                ->unique()
                ->constrained('cars')
                ->cascadeOnDelete()
                ->comment('Привязанная машина');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
}
