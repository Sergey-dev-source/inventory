<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'dcop_user_id',
        'product_id',
        'warehouse_id',
        'count',
        'price',
        'total',
        'commet'
    ];
}
