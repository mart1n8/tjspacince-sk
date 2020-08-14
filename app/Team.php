<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Match;
use App\Club;

class Team extends Model
{
    protected $fillable=['name', 'orderNUm', 'is_active'];
    
    
    public function matchs(){
        return $this->hasMany('App\Match');
    }

    public function matchsWithClub($club_id){
        return Match::where('club_id', $club_id)->where('team_id', $this->id)->orderBy('match_datetime', 'DESC')->get();
    }
    

    public function lastMatch(){
        $today = Date("Y-m-d H:i");
        if($match = Match::select('matches.*')->where('team_id', $this->id)->where('match_datetime', '<=', $today)->where('result', '<>', "")
                                                ->join('clubs', 'clubs.id', '=', 'matches.club_id')
                                                ->orderBy('match_datetime', 'DESC')
                                                ->first())
            {
                return $match;
            }
        return false;
    }
    
    public function nextMatch(){
        $today = Date("Y-m-d");
        if($match = Match::select('matches.*')->where('team_id', $this->id)->where('match_datetime', '>=', $today)->where('result', "")
                                                ->join('clubs', 'clubs.id', '=', 'matches.club_id')
                                                ->orderBy('match_datetime', 'ASC')
                                                ->first()){
                return $match;
            }
        return false;
    
    }
}