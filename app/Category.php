<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    function UserTable(){
        return $this->belongsTo('App\User', 'added_by');
    }
    function productTable(){
        return $this->hasMany('App\Product');
    }
}
