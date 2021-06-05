<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Aristides\Helpers\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'user_id',
        'name',
        'number',
        'best_date',
        'due_date',
        'limit',
    ];

    public function setLimitAttribute(string $value): void
    {
        $this->attributes['limit'] = Helpers::formatMoneyToDatabase($value);
    }
}
