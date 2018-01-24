<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $tweets = DB::table('tweets')->select()->where([
            ['user_id', '=', Auth::user()->id],
            ['active', '=', 1]
        ])->paginate(3);
        if (count($tweets) > 0) {
            foreach ($tweets as $tweet) {
                $tweet->content = preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $tweet->content);
                $tweet->deleteUrl = url('/deleteTweet') . "/$tweet->id";
                $tweet->loveUrl = url('/loveTweet') . "/$tweet->id";
                $tweet->favoriteUrl = url('/favoriteTweet') . "/$tweet->id";
            }
        }
        return view('home', ['user' => $user, 'tweets' => $tweets]);
    }
}
