<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "transaction_details";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'harga_bandrol',
        'transaction_number',
        'transaction_id',
        'product_id',
        'qty',
        'diskon_pct',
        'diskon_nilai',
        'harga_diskon',
        'total'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class, "product_id", "id");
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, "transaction_id", "id");
    }
}
