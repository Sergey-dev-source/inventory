<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edited extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'updated',
    ];
    public $timestamps = false;
}
