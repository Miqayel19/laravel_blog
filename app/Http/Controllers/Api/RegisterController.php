<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Auth;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',            
        ]);
    }    
    public function register(Request $request,User $user)
    {
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password']),
        ]);     
        $user = User::where('email',$request->get('email'))->first();
        Auth::login($user);    
        return response()->json(['user' => Auth::user()], 200);                  
    }
}    
