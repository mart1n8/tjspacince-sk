<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use PDF;
use App\Team;
use App\Match;


class PDFController extends Controller
{
    
   public function plagat($date=""){
			$validator = Validator::make(
														['date' => $date],
														['date' => ['date']]
													);
       if($validator->fails() or empty($date)){
           $date = Date("Y-m-d");
       }
       $matchs = Match::orderBy('team_id', 'ASC')->orderBy('match_datetime', 'ASC')->where('locked', '<>' , 1)
                        ->where('match_datetime', '>=' ,$date)
                        ->where('match_datetime', '<=' , date( "Y-m-d", strtotime( "$date + 7 days" )))
                        ->where('result', "")->get();
       
	//VYTVORENIE PDF
        $rotation = count($matchs)>=4 ? "portrait" : "landscape";
        $rating=(1+(4-count($matchs))/10);
				ini_set('memory_limit', '-1');
				$pdf = PDF::loadView('pdf.plagat', compact('matchs', 'date', 'rating'));
				//PDF::setOptions(['dpi' => 100, 'defaultFont' => 'sans-serif']);
        return $pdf->setPaper('a4', $rotation)->stream('tjspacince_plagat_'.$date.'.pdf');  //landscape  portrait
   }

      
   public function tickets($key="", $type="", $count=""){           //type 0=normalny 1=dochodcovky
       if($key!="8Qt5BEzfzEvtbeMbWBMpVQxe"){
            return redirect()->route('/')->with('error', 'Nemáte prístup do tenjto časti stránky.');  
       }
       $type = (!empty($type) && $type==1) ? $type : 0;
       if(!$match = Team::where('id', 1)->first()->nextMatch()){
           return redirect()->route('/')->with('error', 'Momentálne nie je na pláne žiadny zápas.'); 
       }
       
       
       $season = DB::table('seasons')->where('is_current', 1)->first();
       $round = Match::where('team_id', 1)->where('result', '<>', '')->where('season_id', $season->id)->where('match_datetime', '<=', Date("Y-m-d"))->count()+1;
       $price = ($type==0) ? "1" : "0,50";
       $count = !empty($count) ? $count : 50;
       $sutaz = "V.liga Západ";
       
    //VYTVORENIE PDF
	ini_set('memory_limit', '-1');
	$pdf = PDF::loadView('pdf.tickets', compact('type','price', 'count','match','season','round', 'sutaz'));
	return $pdf->setPaper('a4', 'portrait')->stream(date("d.m.Y", strtotime($match->match_datetime)).'_tickets.pdf');
       
   }
           
           
   
   public function fixtures(){
       $teams = Team::where('is_active', 1)->orderBy('orderNum', 'ASC')->get();
       $season = DB::table('seasons')->where('is_current', 1)->first();

       return view('pdf.fixtures', compact('teams', 'season'));
   }
   public function getFixtures(Request $request){
       $season = DB::table('seasons')->where('is_current', 1)->first();
       $years= explode("/", $season->name);

        if($request->input('season_part')==2){      //jar
            $matchs[0] = Match::where('team_id', $request->input('team1'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[1].'-01-01')->where('match_datetime', '<', $years[1].'-07-20')->get();
            $matchs[1] = Match::where('team_id', $request->input('team2'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[1].'-01-01')->where('match_datetime', '<', $years[1].'-07-20')->get();
            $matchs[2] = Match::where('team_id', $request->input('team3'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[1].'-01-01')->where('match_datetime', '<', $years[1].'-07-20')->get();
            $matchs[3] = Match::where('team_id', $request->input('team4'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[1].'-01-01')->where('match_datetime', '<', $years[1].'-07-20')->get();
        }else{                                      //jesen
            $matchs[0] = Match::where('team_id', $request->input('team1'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[0].'-07-21')->where('match_datetime', '<=', $years[0].'-12-31')->get();
            $matchs[1] = Match::where('team_id', $request->input('team2'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[0].'-07-21')->where('match_datetime', '<=', $years[0].'-12-31')->get();
            $matchs[2] = Match::where('team_id', $request->input('team3'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[0].'-07-21')->where('match_datetime', '<=', $years[0].'-12-31')->get();
            $matchs[3] = Match::where('team_id', $request->input('team4'))->where('season_id', $season->id)->where('match_datetime', '>=', $years[0].'-07-21')->where('match_datetime', '<=', $years[0].'-12-31')->get();
        }
        
        $teams[0] = Team::where('id', $request->input('team1'))->first();
        $teams[1] = Team::where('id', $request->input('team2'))->first();
        $teams[2] = Team::where('id', $request->input('team3'))->first();
        $teams[3] = Team::where('id', $request->input('team4'))->first();
        

        $whenString = $request->input('season_part')==1 ? 'jeseň' : 'jar' ;
        $maxMatchs = max($matchs[0]->count(), $matchs[1]->count()+1, $matchs[2]->count(), $matchs[3]->count()+1);
        $res_col = !empty($request->input('res_col')) ? true : false;
        $rat = 1;
        
        ini_set('memory_limit', '-1');
				$pdf = PDF::loadView('pdf.getFixtures', compact('season','teams', 'matchs', 'whenString', 'rat', 'maxMatchs','res_col'));
				return $pdf->setPaper('a4', 'portrait')->stream('TJ Špačince - rozlosovanie_'.$season->name.'_'.$whenString.'_.pdf');      
   }
    
    
    
}
