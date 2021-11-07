<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'create_user_id',
        'reference',
        'additional',
        'channel_id',
        'costs',
        'requested_date',
        'remarks',
        'customer',
        'email',
        'street',
        'city',
        'zip',
        'countryes_id',
        'state_provincy',
        'state_us',
        'phone'
    ];
}
