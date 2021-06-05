<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\EntryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

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
