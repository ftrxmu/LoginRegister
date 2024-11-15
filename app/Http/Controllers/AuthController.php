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
            'role' => ['required', 'in:petugas,pengguna'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'petugas') {
                return redirect()->route('buku.index');
            } elseif (Auth::user()->role == 'pengguna') {
                return redirect()->route('home');
            }
        return redirect()->route('login')->withErrors('Email atau password salah.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
