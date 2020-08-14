<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Match;
use App\Club;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::where('is_active', 1)->orderBy('orderNum', 'ASC')->get();
        $article = Article::where('public_date', '<', Date("Y-m-d H:i"))->where('show_on_homepage', 1)
                                ->orWhere('is_publised', 1)->where('show_on_homepage', 1)
                                ->orderBy('public_date', 'DESC')
                                ->first();
        return view('home.home', compact('teams', 'article'));
    }
    
    public function contactAdmin(){
        $logged = false;
        $user_email = "";
        if(Auth::check()){
            $logged = true;
            $user_email = Auth::user()->email;
        }
        return view('home.contact', compact('logged', 'user_email')); 
    }
    
    
//SPRAVY PRE ADMINISTRATORA
    public function contactAdminSave(Request $request){
        $validator=$this->validateContactAdmin($request);
        if ($validator->fails()) return redirect()->route('home.contactAdmin')->withErrors($validator)->withInput(); 
       
        $msgEmail = trim($request->input('email'));
        $msg = trim($request->input('message'));
        $msgRegUser = Auth::check()==True ? Auth::id() : NULL;
      
        DB::table('contacts_messages')->insert([
                                    'email'=>$msgEmail,
                                    'message'=>$msg,
                                    'reg_user'=> $msgRegUser,
																		'created_at' => Date("Y-m-d H:i:s"),
																		'updated_at' => Date("Y-m-d H:i:s"),
                                  ]);
      
       Mail::send('email.admin.admin-kontakt-info', compact('msgEmail', 'msg', 'msgRegUser'), function ($message) {
            $message->subject('KONTAKTOVANIE ADMINISTRÁTORA');
            $message->from('web@tjspacince.sk', 'tjspacince.sk');
            $message->to('martin.puchly@gmail.com');
        });
        return back()->with('succeed', 'Vaša správa pre administrátora bola odoslaná. Ďakujeme.');      
    }
    
    public function validateContactAdmin($request)
    {
        $messages=[
								'email.email'=>'Nesprávny formát emailu.',
								'message.min'=>'Správa musí obsahovať minimálne :min znakov.',
								'message.max'=>'Správa môže obsahovať maximálne :max znakov.',
								'message.required'=>'Správa nemôže byť prázdna.',
                'g-recaptcha-response.required'=>'Musíš potvrdiť že nie si robot!',
                'g-recaptcha-response.captcha'=>'Musíš potvrdiť že nie si robot!',
				];
	
        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'message' => 'required|min:15|max:1500',
            'g-recaptcha-response' => 'required|captcha',
        ], $messages);
			return $validator;
    }
    
    
}
