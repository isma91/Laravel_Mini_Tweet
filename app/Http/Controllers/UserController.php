<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {

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
        if (count($errField) > 0) {
            $fields = "";
            foreach($errField as $key => $value) {
                $fields = $fields . ", " . $value;
            }
            $fields = substr($fields, 2);
            Session::flash('message', 'The following field are empty: ' . $fields . ' !!');
            Session::flash('alert-class', 'alert-failed');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        } elseif (strlen($pass) <= 3 || strlen($pass2) <= 3) {
        } elseif ($pass !== $pass2) {
        } else {
            $user = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'login' => $username,
                'email' => $email,
                'pass' => Hash::make($pass)
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
}
