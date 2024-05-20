<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "products";
    public $incrementing = true;
    public $timestamps = true;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('product', 'like', '%'.$search.'%');
            $query->orWhere('sku', 'like', '%'.$search.'%');
        });
    }
    protected $fillable = [
        'sku',
        'product',
        'price'
    ];
}
