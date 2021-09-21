<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function viewSign()
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect()->route('users');
            }else{
                return redirect()->route('data', Auth::user()->user_token);
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
                return redirect()->route('data', Auth::user()->user_token)->with('message', '2');
            }           
        } else {
            return redirect()->back()->with('message', '3');
        }
    }

    public function postLogout()
    {
        Auth::logout();
        $rememberMeCookie = Auth::getRecallerName();
        
        $cookie = Cookie::forget($rememberMeCookie);

        return Redirect::to('/')->withCookie($cookie);
    }
}
