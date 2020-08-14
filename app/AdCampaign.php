<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdCampaign extends Model
{
    protected $fillable = ['name', 'company', 'generalURL', 'points'];
    protected $appends = ['PointsStr'];


    public function ads(){
      return $this->hasMany(Ad::class);
    }

    public function getPointsStrAttribute(){
        if($this->points===-1){
          return "∞";
        }
        return $this->points;
    }

}
