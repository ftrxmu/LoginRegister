<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function viewregister(){
        return view('login.register');
    }
    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:user,email'],
            'password' => ['required'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('login')->with('success','Registrasi berhasil silahkan login');
    }
    public function viewlogin(){
        return view('login.login');
    }
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'unique:user,email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate(); 
            return redirect()->intended('/home');
        }
        throw ValidationException::withMessages([
            'email' => ['Email atau password salah.'],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
