<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'image', 'description'
    ];

    public function getFeaturedAttribute($image) 
    {
        return asset($image);
    }
}
