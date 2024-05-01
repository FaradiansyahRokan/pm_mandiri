<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use HasFactory, SoftDeletes;

    public function transactions() :BelongsTo {
        return $this->belongsTo(Transaction::class, 'id_transaction', 'id');
    }

    public function products() :HasMany {
        return $this->hasMany(Product::class, 'id_product', 'id');
    }
}
