<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Collection;

class CreditCardService implements ServiceInterface
{
    public function list(): Collection
    {
        return CreditCard::orderBy('name')->get();
    }

    public function store($data): CreditCard
    {
        return CreditCard::create($data);
    }
}
