<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class);
    }
}
