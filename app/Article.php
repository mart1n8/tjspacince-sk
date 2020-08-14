<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Article extends Model
{
    protected $fillable = ['title', 'text', 'slug', 'tags', 'user_id', 'public_date', 'is_publised', 'num_views', 'show_on_homepage', 'fb_share_img'];

    public function user(){
        return User::select('id', 'name')->find($this->user_id);
    }


    public function pubDate(){
        if(empty($this->public_date)){
            return $this->updated_at;
        }
        return $this->public_date;
    }


    public function getTagsLinks(){
        $link_tags='';
        $tags=explode(',' ,$this->tags);
        foreach($tags as $tag){
            $link_tags.=' <a href="'.route('article.index.tag', $tag).'" title="'.$tag.'">'.$tag.'</a>, ';
        }
        return rtrim($link_tags,", ,");
    }

}
