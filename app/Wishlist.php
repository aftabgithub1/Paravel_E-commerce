<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function productTable(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
