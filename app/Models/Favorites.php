<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status_stock', 'price'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_products', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
