<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView(Request $request)
    {
        $page_title =  'Login';
        $page_description =  'Some Description';
       
        return view('login.login', compact('page_title', 'page_description'));
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
                return redirect('/admin/employees');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

}
