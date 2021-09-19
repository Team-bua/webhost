<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function viewSign()
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect()->route('users');
            }else{
                return redirect()->route('data');
            }
        }else{
            return view('admin.signin');
        }
    }

    public function postSignIn(LoginRequest $request)
    {
        $remember = false;
        if(isset($request->rememberMe)){
            $remember = true;
        }
        $credentaials = array('email' => $request->email, 'password' => $request->password);
        if (Auth::attempt($credentaials, $remember)) {
            if(Auth::user()->role == 1){
                return redirect()->route('users')->with('message', '2');
            }else{
                return redirect()->route('data')->with('message', '2');
            }           
        } else {
            return redirect()->back()->with('message', '3');
        }
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('signin.view');
    }
}
