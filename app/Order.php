<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders"; 
    
    public function Size(){
        return $this->belongsTo('App\Size');
    }
    public function User(){
        return $this->belongsTo('App\User');
    }
    public function Item(){
        return $this->belongsTo('App\Item');
    }
}
