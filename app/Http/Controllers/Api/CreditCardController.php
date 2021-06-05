<?php

namespace App\Http\Controllers\Api;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use App\Services\CreditCardService;
use App\Http\Controllers\Controller;

class CreditCardController extends Controller
{
    public function index()
    {
        return CreditCard::where('status', true)->orderBy('name')->get();
    }

    public function store(Request $request)
    {
        $store = (new CreditCardService())->store($request->all());

        if (! $store) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro para realizar o cadastro'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cadastro realizado com sucesso'
        ], 200);
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
