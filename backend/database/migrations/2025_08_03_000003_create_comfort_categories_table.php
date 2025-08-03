<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComfortCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('comfort_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Название категории комфорта');
            $table->integer('level')->unsigned()->comment('Уровень: 1 – первая, 2 – вторая и т.д.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comfort_categories');
    }
}
