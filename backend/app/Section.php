<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Section extends Model
{
    public function category() {
        return $this->hasMany(Category::class);
    }
}
