<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UserController@displayLogin');

/* testing to use redirect action but laravel can't find my method... */
/*Route::get('/{page}', function ($page) {
    if ($page == "/" || empty($page)) {
        $page = "login";
    }
    $allowedPageGuest = ['login', 'register'];
    foreach ($allowedPageGuest as  $value) {
        if ($page === $value) {
            return redirect()->action('UserController@display', ['page' => $value]);
            break;
        }
    }
    return abort(404);
});*/

Route::get('/login', 'UserController@displayLogin');

Route::post('/login', 'UserController@login');

Route::get('/register', 'UserController@displayRegister');

Route::post('/register', 'UserController@register');

Route::get('/forgotPass', 'UserController@displayForgotPass');

Route::post('/logout', 'UserController@logout');

Route::get('/home', 'PanelController@displayHome');

Route::post('/sendTweet', 'TweetController@sendTweet');

Route::post('/deleteTweet/{idTweet}', 'TweetController@deleteTweet');