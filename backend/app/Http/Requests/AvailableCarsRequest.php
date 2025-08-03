<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvailableCarsRequest extends FormRequest
{
    /**
     * Определяем, что запрос может делать аутентифицированный пользователь.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Правила валидации полей запроса.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'start_at'  => ['required', 'date', 'before:end_at'],
            'end_at'    => ['required', 'date', 'after:start_at'],
            'model'     => ['nullable', 'string', 'max:255'],
            'category'  => ['nullable', 'integer', Rule::exists('comfort_categories', 'id')],
        ];
    }

    /**
     * Чистые данные после валидации.
     *
     * @return array{start_at:\Carbon\Carbon, end_at:\Carbon\Carbon, model?:string, category?:int}
     */
    public function validated(): array
    {
        $data = parent::validated();
        return [
            'start_at' => \Carbon\Carbon::parse($data['start_at']),
            'end_at'   => \Carbon\Carbon::parse($data['end_at']),
            'model'    => $data['model']  ?? null,
            'category' => $data['category'] ?? null,
        ];
    }
}
