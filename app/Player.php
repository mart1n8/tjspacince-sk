<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    
    protected $fillable=['firstname', 'lastname', 'birth_date', 'photo', 'fn_id'];








    public function getName(){
        return $this->firstname.' '.$this->lastname;
    }
    public function getTurnName(){
        return $this->lastname.' '.$this->firstname;
    }
    
    public function statistics()
    {
        return $this->hasMany('App\PlayerStatistic');
    }
    
    
}
