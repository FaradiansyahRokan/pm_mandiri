<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'list_size', 'list_flavour', 'list_menu'
    ];

    public function products(): HasOne
    {
        return $this->hasOne(Product::class, 'id_product', 'id');
    }
}