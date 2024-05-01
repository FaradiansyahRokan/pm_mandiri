<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'status', 'notes', 'total_price'
    ];

    public function address() :HasOne {
        return $this->hasOne(Address::class, 'id_address', 'id');
    }

    public function items() :HasMany {
        return $this->hasMany(TransactionItem::class, 'id_transaction', 'id');
    }
}