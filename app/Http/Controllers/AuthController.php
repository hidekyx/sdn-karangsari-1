<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        else {
            return view("dashboard.main", [
                'page' => "Login",
            ]);
        }
    }

    public function login_action(Request $request) {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string',
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $remember = $request->remember ? true : false ;

        Auth::attempt($data, $remember);
    
        if (Auth::check()) {
            User::where('id_user',Auth::user()->id)->update(['lastlog' => \Carbon\Carbon::now()]);
            if(Auth::user()->role == "Admin") {
                return redirect('/dashboard/siswa');    
            }
            else {
                return redirect('/dashboard/');
            }
        }
        else {
            Session::flash('error', 'Email atau password salah');
            return redirect('/login');
        }    
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}