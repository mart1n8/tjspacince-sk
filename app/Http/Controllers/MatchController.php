<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Team;
use App\Match;
use App\Http\Requests\MatchStoreRequest;
use Illuminate\Support\Facades\Input;
use App\Player;
use App\PlayerStatistic;

class MatchController extends Controller
{

    public function adminList($team_slug="", $season_slug=""){
        if(!$team = Team::where('slug', $team_slug)->first()){
            $team = Team::orderBy('id', 'ASC')->first();
        }
        if(!$season = DB::table('seasons')->where('slug', $season_slug)->first()){
            $season = DB::table('seasons')->where('is_current', 1)->first();
        }
        
        $matchs = Match::where('team_id', $team->id)->where('season_id', $season->id)->orderBy('match_datetime', 'ASC')->get();
        $teams = Team::orderBy('orderNum', 'ASC')->get();
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        return view('match.adminList', compact('team', 'season', 'matchs', 'teams', 'seasons'));
    }
    
    
    
    public function show($match){
        if(!$match = Match::where('slug', $match)->first()){
            return redirect()->route('/')->with('error', 'Zápas sa v databáze nenachádza.');
        }
        return view('match.show', compact('match'));
    }
    
    public function index($team_slug=""){
        if(!$team = Team::where('slug', $team_slug)->first()){
            $team = Team::orderBy('id', 'ASC')->first();
        }
        $seasons = DB::table('seasons')->join('matches', 'seasons.id', '=', 'matches.season_id')
                                        ->select('seasons.*', 'matches.season_id')
                                        ->groupBy('matches.season_id')
                                        ->where('matches.team_id', $team->id)
                                        ->orderBy('name', 'DESC')
                                        ->get();
        
        return view('match.index', compact('team', 'seasons'));
    }
    
    public function getMatchsJSON($team_id="", $season_slug=""){
        if(!$season = DB::table('seasons')->where('slug', $season_slug)->first()){
            $season = DB::table('seasons')->where('is_current', 1)->first();
        }
        $matchs = Match::where('team_id', $team_id)->where('season_id', $season->id)->orderBy('match_datetime', 'ASC')->get();
        return response()->json([
            'season_name' => $season->name,
            'matchs' => $matchs
        ]);
    }
    
    public function create(){
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        $teams = Team::where('is_active', 1)->orderBy('name', 'ASC')->get();
        return view('match.create', compact('seasons', 'teams'));
    }
    
    public function store(MatchStoreRequest $request){
        $match=new Match($request->all());
        $match->is_bus = !empty($match->is_bus) ? 1 : 0;
        $match->bus_time = !empty($match->bus_time) ? $match->bus_time : NULL;
        $match->slug = Str::slug($match->team->name.' '.date("dmY-", strtotime($match->match_datetime)).' '.$match->shortMatch);
        $match->save();
        
        return redirect()->route('matchs.create')->with('succeed', 'Zápas bol pridaný.');
    }
    
    
    public function edit($match_id){
        if(!$match=Match::find($match_id)){
            return back()->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        $teams = Team::orderBy('name', 'ASC')->get();
        return view('match.edit', compact('match', 'seasons', 'teams'));
    }
    
    public function update(MatchStoreRequest $request, $match_id){
        if(!$match=Match::find($match_id)){
            return back()->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        $match->fill($request->all());
        $match->is_bus = !empty($request->is_bus) ? 1 : 0;
        $match->bus_time = !empty($request->bus_time) ? $match->bus_time : NULL;
        $match->slug = Str::slug($match->team->name.' '.date("dmY-", strtotime($match->match_datetime)).' '.$match->shortMatch);
        $match->result = !empty($match->result) ? $match->result : "";
        $match->locked = $match->locked=="on" ? 1 : 0;
        $match->cron_lock = $match->cron_lock=="on" ? 1 : 0;
    
        $match->save();
        return redirect()->route('matchs.edit', ['match_id'=>$match->id])->with('succeed', 'Zápas bol upravený.');               
    }
    
    public function setResult(Request $request, $match_id){
        if(!$match=Match::find($match_id)){
            return back()->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        $match->result = trim($request->input('result'));
        $match->save();
        return back()->with('succeed', 'Výsledok zápasu bol upravený.');               
    }
    
    
    public function delete($match_id){
        if(!$match=Match::find($match_id)){
            return redirect()->route('admin.matchs.adminList')->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        $match->delete();
        return redirect()->route('admin.matchs.adminList')->with('succeeed', 'Zápas bol vymazaný.');
    }
    
    
    
    public function setMatchStats($match_id, $active=""){
        if(!$match=Match::find($match_id)){
            return back()->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        if($active=="active"){
            $players = Player::where('is_active', 1)->orderBy('lastname', 'ASC')->get();
            $act=1;
        }else{
            $players = Player::orderBy('lastname', 'ASC')->get();
            $act=0;
        }
        $match_stats = PlayerStatistic::where('match_id', $match_id)->get();
        return view('match.stat', compact('match', 'players', 'match_stats', 'act'));                  
    }
    
    public function saveMatchStats(Request $request, $match_id){
        if(!$match=Match::find($match_id)){
            return back()->with('error', 'Zápas s týmto ID sa v databáze nenachádza.');
        }
        $players = Player::all();
        DB::table('player_statistics')->where('match_id', $match_id)->delete();
        foreach ($players as $player){
            $playerID = $player->id;
            if(!empty($request->input('is_player_'.$playerID))){
                DB::table('player_statistics')->insert([
                            'player_id' => $playerID,
                            'match_id' => $match_id,
                            'season_id' => $match->season_id,
                            'yellowCard' => (!empty($request->input('yellowCard_'.$playerID)) ? 1 : 0),
                            'redCard' => !empty($request->input('redCard_'.$playerID)) ? 1 : 0,
                            'goal' => trim($request->input('goal_'.$playerID)),
                            'basicSquad' => !empty($request->input('basicSquad_'.$playerID)) ? 1 : 0,
                            'shirtNum' => trim($request->input('shirtNum_'.$playerID)),
                            'min_start' => trim($request->input('min_start_'.$playerID)),
                            'min_endup' => trim($request->input('min_endup_'.$playerID))
                        ]);
            }
            
        }
        return back()->with('succeed', 'Štatistika k zápasu bola uložená.');
                
    }
    
    
    public function buChange(){
        DB::table('matches')->where("bus_time", "00:00:00")->update([
            'bus_time' => NULL,
        ]);
        return "OK";
    }
    
    
}
