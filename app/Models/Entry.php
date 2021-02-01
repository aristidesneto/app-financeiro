<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'user_id', 'category_id', 'credit_card_id', 'bank_account_id', 'type', 'title', 'amount', 'parcel', 'due_date', 'payday', 'is_recurring', 'start_date', 'sequence'
    ];

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function credit_card()
    {
        return $this->belongsTo(CreditCard::class);
    }
}
