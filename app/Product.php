<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    function multiplePhotosTable(){
        return $this->hasMany('App\Product_multiple_photo', 'product_id');
    }
    function categoryTable(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
