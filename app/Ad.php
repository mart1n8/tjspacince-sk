<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{

  protected $fillable = ['title', 'url','banner', 'banner_size', 'adCampaign_id'];

  public function campaign(){
    return $this->belongsTo(AdCampaign::class);
  }



}
