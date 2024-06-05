<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_address',
        'notes',
        'total_price',
        'status',
        'ongkir',
        'berat'
    ];
    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'id_transaction');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'id_address', 'id');
    }
}