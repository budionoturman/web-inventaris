<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('auth/login');
    }
    
    public function authentication(Request $request){

        $messages = [
            'username.required' => 'Username is required',
            'username.exists' => 'Username Salah',
            'password.required' => 'Password is required',
        ];

        $validator = Validator::make($request->all(),[
            'username' => 'required|exists:users',
            'password' => 'required'
        ], $messages);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        } else {

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $request->session()->regenerate();
     
                return redirect()->intended('/');
            };
            return redirect()->back()->withInput($request->only('username'))
                    ->withErrors([
                        'password' => 'Password Salah'
                    ]);
        }
        // $credentials = $request->validate([
        //     'user_name' => ['required'],
        //     'password' => ['required'],
        // ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
