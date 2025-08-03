<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComfortCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'level'];

    /**
     * Должности, которым разрешена эта категория
     */
    public function positions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Position::class,
            'comfort_category_position'
        );
    }

    /**
     * Модели автомобилей данной категории
     */
    public function carModels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
