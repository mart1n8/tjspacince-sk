<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    
    protected $fillable = ['name', 'short_name', 'city', 'slug', 'about', 'website', 'arena_gps', 'emblem'];

    
    public function matchs(){
        return $this->hasMany('App\Match');
    }
    
    
    
    public function getName(){
        return $this->name;
    }
    
    public function getShortName(){
        if(empty($this->short_name)){
           return $this->name; 
        }
        return $this->short_name;
    }
    

    
}
