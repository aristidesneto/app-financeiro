<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\EntryService;
use App\Http\Controllers\Controller;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type === 'expense' ? 'expense' : 'income';
        $date = Carbon::createFromFormat('Y-m', $request->month)->format('Y-m');

        $params = [
            'type' => $type,
            'period' => [
                'year' => explode('-', $date)[0],
                'month' => explode('-', $date)[1]
            ]
        ];
        $entries = (new EntryService())->getEntries($params);

        return response()->json($entries);
        // return response()->json([
        //     'data' => $entries,
        //     'total_expense' => $entries->where('credit_card_id', null)->sum('amount'),
        //     'total_creditcard' => $entries->where('credit_card_id', !null)->sum('amount')
        // ]);
    }

    public function store(Request $request)
    {
        $store = (new EntryService())->store($request->all());

        if ($store) {
            return response()->json([
                'status' => 'success',
                'message' => 'Cadastro realizado com sucesso'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para realizar o cadastro'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
