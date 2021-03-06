<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\EntryService;
use App\Http\Controllers\Controller;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type === 'expense' ? 'expense' : 'income';

        $params = [
            'type' => $type,
            'period' => [
                'month' => explode('/', $request->month)[1],
                'year' => explode('/', $request->month)[0]
            ]
        ];
        $entries = (new EntryService())->getEntries($params);

        return response()->json([
            'data' => $entries,
            'totalExpense' => number_format($entries->where('credit_card_id', null)->sum('amount'), 2, ',', '.'),
            'totalCard' => number_format($entries->where('credit_card_id', !null)->sum('amount'), 2, ',', '.')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
