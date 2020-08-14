<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Http\Requests\PlayerStoreRequest;
use App\PlayerStatistic;
use Illuminate\Support\Facades\DB;


class PlayerController extends Controller
{
    
    public function adminList($active=""){
        if($active=="active"){
            $players = Player::where('is_active', 1)->orderBy('lastname', 'ASC')->paginate(30);
            $act=1;
        }else{
            $players = Player::orderBy('lastname', 'ASC')->paginate(20);
            $act=0;
        }
        return view('player.adminList', compact('players', 'act'));
    }

    
    public function index($season_name=""){
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        if(empty($season_name) or !$season = DB::table('seasons')->where('slug', $season_name)->first()){
            $season = DB::table('seasons')->where('is_current', 1)->first();
        }
        
        $seasons = DB::table('player_statistics')->select('seasons.name', 'seasons.slug', 'seasons.id', 'player_statistics.season_id')
                                                 ->groupBy('player_statistics.season_id')
                                                 ->join('seasons', 'player_statistics.season_id', '=', 'seasons.id')
                                                 ->orderBy('seasons.name', 'DESC')
                                                 ->get();
       
        $playerStats = PlayerStatistic::select('player_id', DB::raw('SUM(goal) as goals'), DB::raw('SUM(yellowCard) as yellowCards'), DB::raw('COUNT(redCard) as numMatchs'), DB::raw('SUM(redCard) as redCards'))
                                                                        ->where('season_id', $season->id)
                                                                        //->where('player_id', $playerListStat->player_id)
                                                                        ->groupBy('player_id')
                                                                        ->get();
        
       /* 
        return response()->json([
            'seasons' => $seasons,
            'season' => $season,
            'playerStats' => $playerStats
        ]);
        */
        return view('player.index', compact('seasons', 'season', 'playerStats'));
    }
    
    public function show(){
        
    }
    
    public function create(){
        return view('player.create');
    }
    public function store(PlayerStoreRequest $request){
        $player=new Player($request->all());

        if($player->photo && $player->photo->isValid()) {
                $fileName = str_random(40).'.'.$player->photo->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU        
                $image = Image::make($player->photo);
                $image->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('uploads/players/'.$fileName));
                $player->photo = $fileName;                
        }
        $player->is_active = !empty($request->is_active) ? 1 : 0;
        $player->save();
        
        return redirect()->route('player.create')->with('succeed', 'Hráč bol pridaný.');  
        
    }
    
    public function edit($player_id){
        if(!$player=Player::find($player_id)){
            return redirect()->route('player.adminList')->with('error', 'Hráč s týmto ID neexistuje.');  
        }
        return view('player.edit', compact('player'));
    }
    
    public function update(PlayerStoreRequest $request, $player_id){
        if(!$player=Player::find($player_id)){
            return redirect()->route('player.adminList')->with('error', 'Hráč s týmto ID neexistuje.');  
        }
        $player->fill($request->all());

         if($player->photo && $player->photo->isValid()) {
            $fileName = str_random(40).'.'.$player->photo->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU        
            $image = Image::make($player->photo);
            $image->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('uploads/players/'.$fileName));
            $player->photo = $fileName;                
        }
        $player->is_active = !empty($request->is_active) ? 1 : 0;
        $player->save();
        return redirect()->route('player.edit', ['player_id'=>$player->id])->with('succeed', 'Hráč bol upravený.');      
    }
    
    
    public function switchactive($player_id){
        if(!$player=Player::find($player_id)){
            return redirect()->route('player.adminList')->with('error', 'Hráč s týmto ID neexistuje.');  
        }
        if(!empty($player->is_active)){
            $player->is_active=0;
        }else{
            $player->is_active=1;
        }
        $player->save();
        return back()->with('succeed', 'Hráč bol upravený.');  
    }
    
    
    public function delete($player_id){
        if(!$player=Player::find($player_id)){
            return redirect()->route('player.adminList')->with('error', 'Hráč s týmto ID neexistuje.');  
        }
        $player->delete();
        return redirect()->route('player.adminList')->with('error', 'Hráč bol vymazaný.');  
    }
}
