<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','image','des'];

    public function getImageAttribute($value)
    {
        return asset('uploads/products/'.$value);
    }
}
