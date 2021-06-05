<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'user_id', 'name', 'number', 'best_date', 'due_date', 'limit'
    ];

    public function setLimitAttribute($value)
    {
        $this->attributes['limit'] = formatMoney2Db($value);
    }
}
