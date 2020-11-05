<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $fillable = ['review', 'star'];
    public function productTable(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
