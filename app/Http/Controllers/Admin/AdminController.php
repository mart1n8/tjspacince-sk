<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index(){
        $noReadMsg = DB::table('contacts_messages')->where('read', 0)->count();
        return view('admin.index', compact('noReadMsg'));
    }
    
    public function contactsList(){
        $messages = DB::table('contacts_messages')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }
    public function contactsShow($msgID){
        if(!$message = DB::table('contacts_messages')->where('id', $msgID)->first()){
            return redirect()->route('admin.kontakt-admin')->with('error', 'Správa sa v databáze nenachádza.');
        }
        $user = NULL;
        if($message->reg_user!=NULL){
            $user = DB::table('users')->select('name', 'email', 'id')->where('id', $message->reg_user)->first();
        }
        return view('admin.contact.show', compact('message', 'user'));
    }
    public function contactsReadSwitch($msgID){
        if(!$message = DB::table('contacts_messages')->where('id', $msgID)->first()){
            return redirect()->route('admin.kontakt-admin')->with('error', 'Správa sa v databáze nenachádza.');
        }
        if($message->read==0){
            $msgRead=1;
            $spr = "prečítaná";
        }else{
            $msgRead=0;
            $spr = "neprečítaná";
        }
        $message = DB::table('contacts_messages')->where('id', $msgID)->update(['read' => $msgRead, 'updated_at'=>Date('Y-m-d H:i:s')]);
        return redirect()->route('admin.kontakt-admin.show', ['msgID'=>$msgID])->with('succeed', 'Správa bola označená ako '.$spr.'.');
    }
        public function contactsReadDel($msgID){
            if(!$message = DB::table('contacts_messages')->where('id', $msgID)->delete()){
                return redirect()->route('admin.kontakt-admin')->with('error', 'Správa nebola vymazaná.');
            }
            return redirect()->route('admin.kontakt-admin')->with('error', 'Správa bola vymazaná.');
        }
    
    
}
