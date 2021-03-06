<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'user_id', 'name', 'description', 'color'
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
