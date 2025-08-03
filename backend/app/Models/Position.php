<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    /** @var array<string> Разрешённые для массового заполнения поля */
    protected $fillable = ['name'];

    /**
     * Категории комфорта, доступные для данной должности
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comfortCategories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            ComfortCategory::class,
            'comfort_category_position'
        );
    }

    /**
     * Сотрудники, закреплённые за этой должностью
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
