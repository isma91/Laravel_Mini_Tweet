<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    
    public function checkAuth () {
        if (!Auth::check()) {
            Session::flash('message', 'You must be connected to be here !!');
            Session::flash('alert-class', 'alert-failed');
            return false;
        }
        return true;
    }

    public function displayHome () {
        if (!$this->checkAuth()) {
            return redirect('/login');
        }
        $user = [
            'firstname' => Auth::user()->firstname,
            'lastname' => Auth::user()->lastname,
            'login' => Auth::user()->login,
            'email' => Auth::user()->email,
            'avatar' => Auth::user()->avatar,
            'createdDate' => Auth::user()->created_at->toDateTimeString()
        ];
        return view('home', $user);
    }
}
