<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\View\View;

class CreditCardController extends Controller
{
    public function index(): View
    {
        $creditCards = CreditCard::orderBy('name')->get();

        return view('credit-cards.index', [
            'credit_cards' => $creditCards,
        ]);
    }
}
