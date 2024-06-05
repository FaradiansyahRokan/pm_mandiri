<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryFlavour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'list_flavour'
    ];

    public function productFlavour(): HasMany {
        return $this->hasMany(Product::class, 'id_category_flavour', 'id');
    }
}