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
                return redirect()->route('dashboard');
            } else {
                // Authentication failed
                return back()->withErrors([
                    'message' => 'Invalid credentials',
                ]);
            }
        }
        return $this->render($data, 'login');
    }


    private function render(array $data, string $page) {
        // you can add other data to be used on admin before rendering
        return view($page, $data);
    }
}
