<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComfortCategory;
use Illuminate\Http\JsonResponse;

class ComfortCategoryController extends Controller
{
    /**
     * Возвращает все категории комфорта.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = ComfortCategory::orderBy('level')->get(['id','name','level']);

        return response()->json([
            'data' => $categories,
        ]);
    }
}
