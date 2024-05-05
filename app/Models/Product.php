<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_product', 'description_product', 'price', 'qty', 'image_product', 'id_category_flavour', 'id_category_size', 'id_category_menu'
    ];

    public function categoryFlavour(): HasMany
    {
        return $this->hasMany(CategoryFlavour::class, 'id_category_flavour', 'id');
    }
    public function categoryMenu(): HasOne
    {
        return $this->hasOne(CategoryMenu::class, 'id_category_menu', 'id');
    }
    public function categorySize(): HasOne
    {
        return $this->hasOne(CategorySize::class, 'id_category_size', 'id');
    }
    
}
