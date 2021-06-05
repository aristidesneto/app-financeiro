<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type) {
            $type = $request->type === 'expense' ? 'expense' : 'income';
            return Category::where('type', $type)->orderBy('name')->get();
        }

        return Category::orderBy('name')->get();
    }
}
