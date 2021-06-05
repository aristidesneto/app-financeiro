<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    public function index()
    {
        $creditCards = CreditCard::orderBy('name')->get();

        return view('credit-cards.index', [
            'credit_cards' => $creditCards
        ]);
    }

    public function edit(CreditCard $creditCard)
    {
        //
    }

    public function update(Request $request, CreditCard $creditCard)
    {
        //
    }

    public function destroy(CreditCard $creditCard)
    {
        //
    }
}
