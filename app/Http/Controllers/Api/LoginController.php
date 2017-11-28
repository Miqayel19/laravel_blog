<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User; 
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    public function login(Request $request,User $user)
    {
        $logged_user = $request->all();
        if(Auth::attempt(['email'=>$logged_user['email'],'password'=>$logged_user['password']]))
        {
             $user = User::where('email',$request->get('email'))->first();
             Auth::login($user);  
            return response()->json(['user' => Auth::user()],200);
        }
        return response()->json(['Message'=>"Incorrect Login or Password"],400);  
    }
    public function logout(){
        Auth::logout();
        return response()->json(['message' => "403"], 200);
    }
    
}    
