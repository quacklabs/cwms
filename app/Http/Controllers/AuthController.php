<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request) {
        $data = [
            "title" => "Login",
        ];

        if($request->method() == "POST") {
            $credentials = $request->validate([
                "username" => ['required', 'string'],
                "password" => ['required', 'string']
            ]);
            
            if (Auth::attempt($credentials)) {
                // Authentication successful
                $user = Auth::user();
                if($user->status === false) {
                    return back()->withErrors([
                        'message' => 'Account Suspended',
                    ]);
                }
                $user->generateApiToken();

                return redirect()->route('dashboard');
            } else {
                // Authentication failed
                return back()->withErrors([
                    'message' => 'Invalid credentials',
                ]);
            }
        }
        return parent::render($data, 'login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
