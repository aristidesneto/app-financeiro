<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\EntryService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EntryController extends Controller
{
    protected EntryService $entryService;

    public function __construct(EntryService $entryService)
    {
        $this->entryService = $entryService;
    }

    public function index(): View
    {
        $now = Carbon::now();

        return view('expenses.index', [
            'year' => $now->year,
            'currentMonth' => $now->format('Y/m'),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->entryService->store($request->all()), 201);
    }

    public function entries(): View
    {
        return view('entries.create');
    }
}
