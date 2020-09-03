<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use Illuminate\Support\Facades\Mail;
use App\Team;

class CronController extends Controller
{

    public function plagat($key){
        if($key<>"WCd8EBLvvkT4p78RvC46SFE6") die();
				$today = Date("Y-m-d");
				//$dateEnd = date("Y-m-d", strtotime($today.' + 6 days'));
				$TodayName = Date("D");

        $matchs = Match::orderBy('team_id', 'ASC')->where('locked', '<>' , 1)
                        ->where('match_datetime', '>=' ,$today)
                        ->where('match_datetime', '<=' , date( "Y-m-d", strtotime( "$today + 6 days" )))
                        ->where('result', "")->get();


        if($matchs->count()==0) die();
        if($TodayName=="Tue"){
           Mail::send('email.plagat.check', compact('matchs'), function ($message) {
								$message->subject('Futbal - plagát');
								$message->from('web@tjspacince.sk', 'tjspacince.sk');
								$message->to('martin.puchly@gmail.com')->to('michal.puchly@gmail.com');
            });
            return "OK!";
            //return view('email.plagat.check', compact('matchs'));

        }else if($TodayName=="Wed"){
            if($aNextMatch = Match::orderBy('team_id', 'ASC')
                                ->where('team_id', 1)
                                ->where('match_datetime', '>=' ,$today)
                                ->where('match_datetime', '<=' , date( "Y-m-d", strtotime( "$today + 6 days" )))
                                ->where('result', "")->first()){

                $needTickets = $aNextMatch->home_away==0 ? True : False;
            }
            Mail::send('email.plagat.print', compact('matchs', 'needTickets'), function ($message) {
									$message->subject('Futbal - plagát');
									$message->from('web@tjspacince.sk', 'tjspacince.sk');
									$message->to('martin.puchly@gmail.com');
            });
            return "OK!";
            //return view('email.plagat.print', compact('matchs', 'needTickets', 'aNextMatch'));

        } else if($TodayName=="Thu"){
            Mail::send('email.plagat.info', compact('matchs', 'needTickets'), function ($message) {
									$message->subject('Futbal - plagát');
									$message->from('web@tjspacince.sk', 'tjspacince.sk');
									$message->to('starosta@spacince.sk')->to('jan.pinkas@spacince.sk')->to('webmaster@spacince.sk')>to('podatelna@spacince.sk')->bcc('martin.puchly@gmail.com');
            });
            return "OK!";
            //return view('email.plagat.info', compact('matchs'));
        }
    }



}
