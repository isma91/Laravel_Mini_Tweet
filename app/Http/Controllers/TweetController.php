<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function sendTweet (Request $request) {
        $textareaTweet = $request->input('textareaTweet');
        $tweet = nl2br($textareaTweet);
        $db = DB::table('tweets')->insert(['user_id' => Auth::user()->id, 'content' => $tweet]);
        if (!$db) {
            Session::flash('message', 'Something got wrong when we try to send the tweet please retry or send email to the admin !!');
            Session::flash('alert-class', 'alert-failed');
        }
        return redirect('/home');
    }

    public function deleteTweet ($idTweet) {
        $db = DB::table('tweets')->where('id', $idTweet)->update(['active' => 0]);
        if (!$db) {
            Session::flash('message', 'Something got wrong when we try to delete the tweet please retry or send email to the admin !!');
            Session::flash('alert-class', 'alert-failed');
        }
        return redirect('/home');
    }
}
