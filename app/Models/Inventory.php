<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'count',
        'product_id',
        'warehouse_id'
    ];
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
