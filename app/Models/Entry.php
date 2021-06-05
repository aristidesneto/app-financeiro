<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'user_id',
        'category_id',
        'credit_card_id',
        'bank_account_id',
        'type',
        'title',
        'amount',
        'parcel',
        'total_parcel',
        'due_date',
        'payday',
        'is_recurring',
        'start_date',
        'sequence',
    ];

    protected $dates = [
        'due_date',
        'payday',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = formatMoney2Db($value);
    }
}
