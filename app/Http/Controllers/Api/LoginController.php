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
            'password' => 'required|string|min:6',
        ]);
    }
    public function login(Request $request,User $user)
    {
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Auth::attempt(['email'=>$inputs['email'],'password'=>$inputs['password']])){
            $user = User::where('email',$request->get('email'))->first();
            Auth::login($user);  
            return response()->json(['status' => 'success','message' => 'Logged successfully','resource' => Auth::user()],201);
        }
        return response()->json(['status' => 'failed','message'=>"Incorrect Login or Password"],400);  
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'success','message' => "You have successfully logout"], 201);
    }  
}    
