<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'sku',
        'uom',
        'image',
        'weight',
        'width',
        'height',
        'color',
        'size',
        'category_id',
        'bin_id'
    ];
    public function inventories(){
        return $this->hasMany(Inventory::class);
    }
}
