<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city', 'province', 'district', 'sub-district', 'detail', 'address_type'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
