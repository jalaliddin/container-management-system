<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCoordinates extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_latitude',
        'address_longitude',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
