<?php

namespace App\Services;

use App\Models\CreditCard;

class CreditCardService implements ServiceInterface
{
    public function list()
    {
        return CreditCard::orderBy('name')->get();
    }
    public function store($data) : bool
    {
        $creditCard = CreditCard::create($data);

        if ($creditCard) {
            return true;
        }

        return false;
    }
}
