<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";
    
        public function Item(){
            return $this->belongsTo('App\Item');
        }
}
