<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'container_price',
        'town',
        'status',
        'container_type',
        'table_1',
        'table_2',
        'table_3',
        'table_4',
        'table_5',
        'table_6',
        'table_7',
        'description',
        'author'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function coordinate()
    {
        return $this->hasOne(OrderCoordinates::class);
    }
}
