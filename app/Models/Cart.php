<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'qty', 'total_price'
    ];

    public function products(): HasOne
    {
        return $this->hasOne(Product::class, 'id_product', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
