<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'payment_id'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
