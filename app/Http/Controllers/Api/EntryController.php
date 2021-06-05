<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EntryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    protected EntryService $entryService;

    public function __construct(EntryService $entryService)
    {
        $this->entryService = $entryService;
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->entryService->entries($request->all()), 200);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->entryService->store($request->all()), 201);
    }
}
