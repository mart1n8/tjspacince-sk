<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    
    public function index($findString=""){
        if(empty($findString)){
            $users = User::select('id', 'name', 'email', 'roles')->orderBy('roles', 'DESC')->orderBy('name', 'ASC')->paginate(20);
        } else{
            $users = User::select('id', 'name', 'email', 'roles')->where('name', 'like', '%'.$findString.'%')->orWhere('email', 'like', '%'.$findString.'%')->orderBy('roles', 'DSC')->orderBy('name', 'ASC')->paginate(20);      
        }
        return view('admin.user.index', compact('users'));
        
    }
    
    
    
    public function delete($user_id){
        if(!$user = User::find($user_id)){
            return back()->with('error', 'Úžívateľ sa v databáze nenachádza.');
        }
        if($user_id==1 or $user_id==Auth::id() or $user->roles()>=Auth::user()->roles){
            return back()->with('error', 'Tak toto nevymazeš kámo!');
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('succeed', 'Užívateľ bol odstránený.');
        
    } 
    
    
    
}
