<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComfortCategoryPositionTable extends Migration
{
    public function up(): void
    {
        Schema::create('comfort_category_position', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')
                ->constrained('positions')
                ->cascadeOnDelete();
            $table->foreignId('comfort_category_id')
                ->constrained('comfort_categories')
                ->cascadeOnDelete();
            $table->unique(['position_id','comfort_category_id'], 'pos_cat_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comfort_category_position');
    }
}
