<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['quantity'];
    public function productTable(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
 