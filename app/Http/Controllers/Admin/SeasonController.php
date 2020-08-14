<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;


class SeasonController extends Controller
{
    public function index(){
        $seasons = DB::table('seasons')->orderBy('name', 'DESC')->get();
        return view('admin.season.index', compact('seasons'));   
    }
    
    public function store(Request $request){
        DB::table('seasons')->insert(['name'=>trim($request->input('name')), 'slug'=> Str::slug($request->input('name'))]);
        return back()->with('succeed', 'Sezóna bola pridaná.');
    }
    
    public function edit($season_id){
        DB::table('seasons')->where('id', $season_id)->update(['name'=>trim($request->input('name')), 'slug'=> Str::slug($request->input('name'))]);
        return back()->with('succeed', 'Sezóna bola upravená.');
    }
    public function activation(Request $request, $season_id){
        DB::table('seasons')->update(['is_current'=>0]);
        DB::table('seasons')->where('id', $season_id)->update(['is_current'=>1]);
        return back()->with('succeed', 'Sezóna bola aktivovaná.');
    }
    public function delete($season_id){
        DB::table('seasons')->where('id', $season_id)->delete();
        return back()->with('error', 'Sezóna bola vymazaná.');
    }
}
