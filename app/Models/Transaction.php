<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "transactions";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'transaction_number',
        'customer_id',
        'tgl',
        'subtotal',
        'diskon',
        'ongkir',
        'total_bayar'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('transaction_number', 'like', '%'.$search.'%')
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('customer', 'like', '%'.$search.'%');
                });
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, "customer_id", "id");
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, "transaction_id", "id");
    }
}
