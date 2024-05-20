<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "customers";
    public $incrementing = true;
    public $timestamps = true;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('customer', 'like', '%'.$search.'%');
            $query->orWhere('sku', 'like', '%'.$search.'%');
            $query->orWhere('phone', 'like', '%'.$search.'%');
        });
    }
    protected $fillable = [
        'sku',
        'customer',
        'phone'
    ];
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class,"customer_id","id");
    }
}
