<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_product', 'description_product', 'qty', 'image_product', 'id_category_flavour', 'id_category_size', 'id_category_menu'
    ];

    public function categoryFlavour(): BelongsTo
    {
        return $this->belongsTo(CategoryFlavour::class, 'id_category_flavour', 'id');
    }
    public function categoryMenu()
    {
        return $this->belongsTo(CategoryMenu::class, 'id_category_menu', 'id');
    }
    public function categorySize()
    {
        return $this->belongsTo(CategorySize::class, 'id_category_size', 'id');
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'id_product', 'id');
    }
}

