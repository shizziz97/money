<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    public function Category(){
        return $this->belongsTo('App\Category');
    }
    
    public function Images(){
        return $this->hasMany('App\Image');
    }
    
    public function sizes(){
        return $this->belongsToMany('App\Size');
    }

    public function scopeSearch($query , $s){
        return $query->where('parcode','like', $s .'%');
    }
}
