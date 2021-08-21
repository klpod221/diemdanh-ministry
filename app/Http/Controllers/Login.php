<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Exception;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function loginProcess(Request $request)
    {
        try {
            $email = $request->get('email');
            $password = $request->get('password');
            $ministry = Ministry::where('email','=', "$email")->where('passWord','=',"$password")->firstOrFail();
            $request->session()->put('id', $ministry->ministryId);
            $request->session()->put('name', $ministry->name);
            return view('ministry.dashboard.index');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 1);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
