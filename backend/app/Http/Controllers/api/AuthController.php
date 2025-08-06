<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Логин: проверяем email+пароль и регенерируем сессию.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный email или пароль.'],
            ]);
        }

        // Успешный вход: регенерируем сессию (для защиты от фиксации)
        $request->session()->regenerate();

        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Выдаёт данные текущего аутентифицированного пользователя.
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Выход: инвалидируем сессию.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(null, 204);
    }
}
