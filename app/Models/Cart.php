<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user', 'id_product', 'qty', 'id_size'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function size():BelongsTo
{
    return $this->belongsTo(CategorySize::class, 'id_size', 'id');
}
}

