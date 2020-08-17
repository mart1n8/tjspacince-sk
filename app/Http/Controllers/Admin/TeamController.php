<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

use App\Team;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::orderBy('orderNum', 'ASC')->get();
        return view('admin.team.index', compact('teams'));   
    }
    
    public function store(Request $request){
        DB::table('teams')->insert([
            'name'=>trim($request->input('name')), 
            'slug'=> Str::slug($request->input('name')),
            'orderNum'=> Team::count()+1
            ]);
        
        return back()->with('succeed', 'Tím bol pridaný.');
    }
    
    public function edit(Request $request, $team_id){
        DB::table('teams')->where('id', $team_id)->update([
            'name'=>trim($request->input('name')), 
            'slug'=> Str::slug($request->input('name')),
            'orderNum'=> $request->input('orderNum')
            ]);
        return back()->with('succeed', 'Tím bol upravený.');
    }
    
    public function activation($team_id){
        $team = Team::where('id', $team_id)->first();
        $team->is_active = $team->is_active==1 ? 0 : 1;
        $team->save();
        return back()->with('succeed', 'Tím bol aktivovaná.');
    }

    public function delete($team_id){
        DB::table('teams')->where('id', $team_id)->delete();
        return back()->with('error', 'Tím bola vymazaný.');
    }
}
