<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('car_id')
                ->constrained('cars')
                ->cascadeOnDelete();
            $table->timestamp('start_at')->comment('Время начала поездки');
            $table->timestamp('end_at')->comment('Время окончания поездки');
            $table->timestamps();

            // индекс для быстрого поиска по интервалу
            $table->index(['car_id', 'start_at', 'end_at'], 'car_time_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
}
