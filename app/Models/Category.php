<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'color',
    ];

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}
