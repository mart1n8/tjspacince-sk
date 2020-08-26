<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Match extends Model
{
    
    protected $fillable=['team_id', 'season_id', 'club_id', 'match_datetime', 'is_bus', 'bus_time', 'result', '	short_info', 'about', 'home_away', 'fn_ID', 'locked', 'locked_reason', 'cron_lock'];
    protected $appends = ['matchDateString', 'shortDate', 'shortMatch', 'resultColor'];
    
    public function club(){
        return $this->belongsTo('App\Club', 'club_id');
    }
    
    public function team(){
        return $this->belongsTo('App\Team', 'team_id');
    }
    
    public function season(){
        return DB::table('seasons')->where('id', $this->season_id)->first();
    }
     
    public function statistics(){
        return $this->hasMany('App\PlayerStatistic', 'match_id');
    }
    
    public function getShortMatchAttribute(){
        if($this->home_away==0){
            return 'TJ Špačince - '.$this->club->getShortName();
        }
        return $this->club->getShortName().' - TJ Špačince';
    }
    
     public function getShortDateAttribute(){
        return date("d.m.Y", strtotime($this->match_datetime));
     }
  
    public function getResultColorAttribute(){
        $clrClass = "text-secondary";
        if(empty($this->result)) return $clrClass;
        $resArr = explode(":", $this->result);
        if(($this->home_away==0 && $resArr[0]>$resArr[1]) or ($this->home_away==1 && $resArr[0]<$resArr[1])){
            $clrClass = "text-success";
        } elseif (($this->home_away==0 && $resArr[0]<$resArr[1]) or ($this->home_away==1 && $resArr[0]>$resArr[1])){
           $clrClass = "text-danger";
        } 
        return $clrClass;
    }
  
    public function getMatchDateStringAttribute(){
        switch (date("N", strtotime($this->match_datetime))) {
            case 1:
                $name_day = "v pondelok";
            break;
            case 2:
                $name_day = "v utorok";
            break;
            case 3:
                $name_day = "v stredu";
            break;
            case 4:
                $name_day = "vo štvrtok";
            break;
            case 5:
                $name_day = "v piatok";
            break;
            case 6:
                $name_day = "v sobotu";
            break;
            default:
            $name_day = "v nedeľu";
        }
        return $name_day.' '.date("j.n.Y", strtotime($this->match_datetime)). ' o '.date("H:i", strtotime($this->match_datetime)). ' hod.';
    }
    
    
    
    public function busTime(){
        if($this->bus_time != NULL){
            return date("H:i", strtotime($this->bus_time));
        }
        
        switch ($this->team_id) {
            case 1:                 // A TIM
                $timeMov = 1.25;     
            break;
            case 2:                 // ZIACI
                $timeMov = 1.5;
            break;
            default:                // ZVYSOK
                 $timeMov = 1;
        }
        return date("H:i", strtotime($this->match_datetime) - ($timeMov*60*60));
    }
    
    
    
    
    
}
