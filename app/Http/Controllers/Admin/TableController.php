<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class TableController extends Controller
{

    public function adminList($team_slug=""){
        if(!$team = Team::where('slug', $team_slug)->first()){
            $team = Team::orderBy('id', 'ASC')->first();
        }
        $teams = Team::orderBy('name', 'ASC')->get();
        $tables = DB::table('tables')->where('tables.team_id', $team->id)
                                ->join('seasons', 'tables.season_id', '=', 'seasons.id')
                                ->select('tables.*', 'seasons.name', 'seasons.slug as seas_slug')
                                ->orderBy('seasons.name', 'DESC')
                                ->get();
        return view('table.adminList', compact('tables', 'team', 'teams'));
    }


    public function show($team_slug="", $season_slug=""){
        if(!$team = Team::where('slug', $team_slug)->first()){
            $team = Team::orderBy('id', 'ASC')->first();
        }
        $seasons = DB::table('tables')->where('team_id', $team->id)
                                        ->join('seasons', 'tables.season_id', '=', 'seasons.id')
                                        ->orderBy('seasons.name', 'DESC')->get();
        return view('table.show', compact('team', 'seasons'));
    }

    public function getTableJSON($team_id="", $season_slug=""){
        if(!$team = Team::find($team_id)){
            $team = Team::find(1);
        }

        if(!$season = DB::table('seasons')->where('slug', $season_slug)->first()){
            $season = DB::table('seasons')->where('is_current', 1)->first();
        }
        if(!$table = DB::table('tables')->where('team_id', $team->id)->where('season_id', $season->id)->first()){
            return redirect ('/')->with('error', 'Tabuľka sa v databáze nenachádza.');
        }
        return response()->json([
            'team_name' => $team->name,
            'season_name' => $season->name,
            'table' => $table->table_text
        ]);
    }




    public function create(){
        $teams = Team::orderBy('name', 'ASC')->get();
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        return view('table.create', compact('teams', 'seasons'));
    }
    public function store(Request $request){
        $validator=$this->validateTable($request);
        if ($validator->fails()){
            return redirect()->route('tables.create')->withErrors($validator)->withInput();
        }

        DB::table('tables')->insert([
                          'title' => trim($request->input('title')),
                          'team_id' => trim($request->input('team_id')),
                          'season_id' => trim($request->input('season_id')),
                          'table_text' => trim($request->input('table_text'))
                ]);

        return redirect()->route('tables.create')->with('succeed', 'Tabuľka bola pridaná.');
    }

    public function edit($table_id){
        if(!$table = DB::table('tables')->where('id', $table_id)->first()){
            return redirect()->route('admin.tables.adminList')->with('error', 'Tabuľka s týmto ID sa v databáze nenachádza.');
        }

        $teams = Team::orderBy('name', 'ASC')->get();
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        return view('table.edit', compact('table', 'teams', 'seasons'));
    }

    public function update(Request $request, $table_id){
        if(!DB::table('tables')->where('id', $table_id)->first()){
            return redirect()->route('admin.tables.adminList')->with('error', 'Tabuľka s týmto ID sa v databáze nenachádza.');
        }
        $validator=$this->validateTable($request);
        if ($validator->fails()){
            return redirect()->route('tables.edit', ['table_id'=>$table_id])->withErrors($validator)->withInput();
        }
        DB::table('tables')->where('id', $table_id)->update([
                          'title' => trim($request->input('title')),
                          'team_id' => trim($request->input('team_id')),
                          'season_id' => trim($request->input('season_id')),
                          'table_text' => trim($request->input('table_text'))]);

        return redirect()->route('tables.edit', ['table_id'=>$table_id])->with('succeed', 'Tabuľka bola upravená.');
    }


    public function validateTable($request)
        {
        $messages=[
    		'team_id.required'=>'Musíte vyplniť pre ktorý tím je tabuľka.',
    		'team_id.integer'=>'Musíte vyplniť pre ktorý tím je tabuľka.',
    		'season_id.required'=>'Musíte vyplniť pre ktorú sezónu je tabuľka.',
                'season_id.integer'=>'Musíte vyplniť pre ktorú sezónu je tabuľka.',
    		'table_text.required'=>'Musíte vyplniť konečnú tabuľku sezóny.',
    		'table_text.min'=>'Musíte vyplniť konečnú tabuľku sezóny. Minimálne :min znakov.',
                'title.required'=>'Musíte vyplniť konečnú tabuľku sezóny. Minimálne :min znakov.',
                'title.min'=>'Musíte vyplniť konečnú tabuľku sezóny. Minimálne :min znakov.',
                'title.max'=>'Musíte vyplniť konečnú tabuľku sezóny. Minimálne :min znakov.',
    	];
        $validator = Validator::make($request->all(), [
                'team_id' => 'required|integer',
                'season_id' => 'required|integer',
                'table_text' => 'required|min:100',
                'title' => 'required|min:10|max:230',
        ], $messages);
    		return $validator;
        }

    public function delete($table_id){
        if(!DB::table('tables')->where('id', $table_id)->delete()){
            return redirect()->route('admin.tables.adminList')->with('error', 'Tabuľka s týmto ID sa v databáze nenachádza.');
        }
        return redirect()->route('admin.tables.adminList')->with('succeed', 'Tabuľka s bola vymazaná.');
    }
}
