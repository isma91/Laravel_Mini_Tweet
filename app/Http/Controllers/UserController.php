<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function checkAuth () {
        if (Auth::check()) {
            Session::flash('message', 'You can\'t go here when you\'re logged !!');
            Session::flash('alert-class', 'alert-failed');
            return false;
        }
        return true;
    }

    public function register (Request $request) {
        $errField = [];
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $username = $request->input('username');
        $email = $request->input('email');
        $pass = $request->input('password');
        $pass2 = $request->input('password2');
        $allField = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'login' => $username,
            'email' => $email,
            'pass' => $pass,
            'pass2' => $pass2
        ];
        foreach($allField as $filed => $value) {
            if (empty(trim($value))) {
                array_push($errField, $value);
            }
        }
        $checkDuplicateUsername = DB::table('users')->select('login')->where('login',  '=', $username)->get();
        $checkDuplicateEmail = DB::table('users')->select('email')->where('email',  '=', $email)->get();
        if (count($errField) > 0) {
            $fields = "";
            foreach($errField as $key => $value) {
                $fields = $fields . ", " . $value;
            }
            $fields = substr($fields, 2);
            Session::flash('message', 'The following field are empty: ' . $fields . ' !!');
            Session::flash('alert-class', 'alert-failed');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('message', 'Your email is not valid !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif (strlen($pass) <= 3 || strlen($pass2) <= 3) {
            Session::flash('message', 'The two password fields must be at least 4 characters long !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif ($pass !== $pass2) {
            Session::flash('message', 'The two password field must be the same !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif (strlen($username) <= 3) {
            Session::flash('message', 'The username must be at least 4 characters long !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif (!$checkDuplicateEmail->isEmpty()) {
            Session::flash('message', 'Email already taken !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif (!$checkDuplicateUsername->isEmpty()) {
            Session::flash('message', 'Username already taken !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } else {
            $user = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'login' => $username,
                'email' => $email,
                'password' => Hash::make($pass)
            ];
            $db = DB::table('users')->insert($user);
            if (!$db) {
                Session::flash('message', 'Something got wrong when we try to register you please send email to the admin !!');
                Session::flash('alert-class', 'alert-failed');
            } else {
                Session::flash('message', 'You successfully registered yourself !! You can now log in !!');
                Session::flash('alert-class', 'alert-success');
            }
            return redirect('/login');
        }
    }

    /*public function display ($page) {
        if (!$this->checkAuth()) {
            return redirect('/home');
        }
        return view($page);
    }*/

    public function displayLogin () {
        if (!$this->checkAuth()) {
            return redirect('/home');
        }
        return view('login');
    }

    public function displayRegister () {
        if (!$this->checkAuth()) {
            return redirect('/home');
        }
        return view('register');
    }

    public function displayForgotPass () {
        if (!$this->checkAuth()) {
            return redirect('/home');
        }
        return view('forgotPass');
    }

    public function login (Request $request) {
        $errField = [];
        $username = $request->input('username');
        $pass = $request->input('password');
        $allField = [
            'login' => $username,
            'password' => $pass
        ];
        foreach($allField as $filed => $value) {
            if (empty(trim($value))) {
                array_push($errField, $value);
            }
        }
        $checkUsernameExist = DB::table('users')->select('login')->where('login',  '=', $username)->get();
        if (count($errField) > 0) {
            $fields = "";
            foreach($errField as $key => $value) {
                $fields = $fields . ", " . $value;
            }
            $fields = substr($fields, 2);
            Session::flash('message', 'The following field are empty: ' . $fields . ' !!');
            Session::flash('alert-class', 'alert-failed');
        } elseif (strlen($pass) <= 3) {
            Session::flash('message', 'The password field must be at least 4 characters long !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif (strlen($username) <= 3) {
            Session::flash('message', 'The username must be at least 4 characters long !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } elseif ($checkUsernameExist->isEmpty()) {
            Session::flash('message', 'This username doesn\'t exist !!');
            Session::flash('alert-class', 'alert-failed');
            return redirect()->back();
        } else {
            $user = DB::table('users')->select('login', 'password', 'active')->where('login', '=', $username)->get();
            $userActive = $user[0]->active;
            if ($userActive !== 1) {
                Session::flash('message', 'Your account was suspended, you must send an email to the admin to get it back !!');
                Session::flash('alert-class', 'alert-failed');
                return redirect()->back();
            } else {
                if (!Auth::attempt(['login' => $username, 'password' => $pass])) {
                    Session::flash('message', 'Wrong username and/or password !!');
                    Session::flash('alert-class', 'alert-failed');
                    return redirect()->back();
                } else {
                    return redirect('/home');
                }
            }
        }
    }

    public function logout () {
        Auth::logout();
        return redirect('/login');
    }
}
