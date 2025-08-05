<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        //return $request->role;


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]);

        return [
            'status' => true
        ];
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == "pendamping") {
                $request->session()->regenerate();
                return [
                    'status' => true,
                    'redirect' => 'pendamping'
                ];
            } else if (Auth::user()->role == "fasilitator") {
                $request->session()->regenerate();
                return [
                    'status' => true,
                    'redirect' => 'fasilitator'
                ];
            }
            else if (Auth::user()->role == "Admin") {
                $request->session()->regenerate();
                return [
                    'status' => true,
                    'redirect' => 'admin'
                ];
            }
        }

        return [
            'email' => 'The provided credentials do not match our records.',
            'status' => false
        ];
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
