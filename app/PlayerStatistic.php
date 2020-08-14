<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerStatistic extends Model
{
    protected $fillable=['player_id', 'match_id', 'season_id', 
                        'yellowCard', 'redCard', 'goal', 'played', 
                        'basicSquad', 'shirtNum', 'min_start', 'min_endup'];

    
    
    public function match(){
        return $this->belongsTo('App\Match', 'match_id');
    }
    
    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }
    
}
