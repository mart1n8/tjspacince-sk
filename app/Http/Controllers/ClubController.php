<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\ClubStoreRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image; 
use App\Team;
use Illuminate\Support\Str;
class ClubController extends Controller
{
    
    public function adminList(){
        $clubs = Club::orderBy('city', 'ASC')->paginate(20);
        return view('club.adminList', compact('clubs'));
    }

    public function show($club){
        if (!$club = Club::where('slug', $club)->first()){
           return redirect ()->route('club.adminList')->with('error', 'Klub s týmto ID neexistuje.'); 
        }
				$teams = Team::orderBy('orderNum', 'ASC')->get();
        return view('club.show', compact('club', 'teams'));
    }
    
    public function search(Request $request)
    {
        $term = $request->input('club');
				$results = array();
				$queries = Club::where('name', 'LIKE', '%'.$term.'%')->orWhere('city', 'LIKE', '%'.$term.'%')->get();
        foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->id, 'name' => $query->getName()];
        }
        return response()->json($results);
    }

    public function create(){
        return view('club.create');       
    }
    
    public function store(ClubStoreRequest $request){
        $club=new Club($request->all());

        if($request->emblem && $club->emblem->isValid()) {
                $fileName = Str::random(40).'.'.$club->emblem->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU        
                $image = Image::make($club->emblem);
                $image->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('uploads/clubs/' .$fileName));
                $club->emblem = $fileName;                
        }
        
        $club->slug = Str::slug($club->name);
        $club->save();
        
        return redirect()->route('club.edit', ['club_id'=>$club->id])->with('succeed', 'Klub bol pridaný.');               
    }
    
    
    public function edit($club_id){
        if (!$club = Club::find($club_id)){
           return redirect ()->route('club.adminList')->with('error', 'Klub s týmto ID neexistuje.'); 
        }
        return view('club.edit', compact('club'));
    }
    
    public function update(ClubStoreRequest $request, $club_id){
        if (!$club = Club::find($club_id)){
           return redirect ()->route('club.adminList')->with('error', 'Klub s týmto ID neexistuje.'); 
        }
        $club->fill($request->all());
        
        if($request->emblem && $club->emblem->isValid()) {
                $fileName = Str::random(40).'.'.$club->emblem->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU        
                $image = Image::make($club->emblem);
                $image->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('uploads/clubs/' .$fileName));
                $club->emblem = $fileName;                
        }
        
        $club->slug = Str::slug($club->name);
        $club->save();
        return redirect()->route('club.edit', ['club_id'=>$club->id])->with('succeed', 'Klub bol upravený.');               
    }
}
