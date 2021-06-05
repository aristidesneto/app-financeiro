<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Services\CreditCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    protected CreditCardService $creditCardService;

    public function __construct(CreditCardService $creditCardService)
    {
        $this->creditCardService = $creditCardService;
    }

    public function index(): JsonResponse
    {
        return response()->json(CreditCard::where('status', true)->orderBy('name')->get(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->creditCardService->store($request->all()), 201);
    }
}
