<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\JsonResponse;

class BankAccountController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(BankAccount::orderBy('name')->get(), 200);
    }
}
