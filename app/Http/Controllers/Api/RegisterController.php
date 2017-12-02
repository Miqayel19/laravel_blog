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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]);
    }    
    public function register(Request $request,User $user)
    {
        $info = $request->all();
        if($info['password'] === $info['conf_pass']){
            User::create([
                'name' => $info['name'],
                'email' => $info['email'],
                'password' => bcrypt($info['password']),
            ]); 
            $user = User::where('email',$request->get('email'))->first();
            Auth::login($user);
            return response()->json(['user' => Auth::user()], 200);
        } 
        return response()->json(['msg'=>'Register failed']);               
    }    
}
