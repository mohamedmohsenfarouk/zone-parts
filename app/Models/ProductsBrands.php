<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsBrands extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'brand_id'
    ];
}
