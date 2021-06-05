<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->type) {
            $type = 'expense' === $request->type ? 'expense' : 'income';

            return response()->json(Category::where('type', $type)->orderBy('name')->get(), 200);
        }

        return response()->json(Category::orderBy('name')->get(), 200);
    }
}
