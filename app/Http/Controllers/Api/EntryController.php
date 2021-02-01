<?php

namespace App\Http\Controllers\Api;

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
    public function index()
    {
        $params = [
            'type' => 'expense',
            'period' => [
                'start_month' => '02',
                'start_year' => '2021',
                'end_month' => null,
                'end_year' => null
            ]
        ];
        $entries = (new EntryService())->getEntries($params);

        return response()->json([
            'data' => $entries,
            'total' => number_format($entries->sum('amount'), 2, ',', '.')
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
