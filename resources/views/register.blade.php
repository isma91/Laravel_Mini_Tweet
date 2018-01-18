<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/google_material_icons.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
    <title>Laravel</title>
</head>
<body>
    <div class="container">
        <div class="row center">
            <h1>Welcome to Todo List !!</h1>
            <h2>Please full in the form to create an account</h2>
        </div>
    </div>
    <div class="container">
        <form class="row">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" name="firstname" type="text">
                    <label for="firstname">Firstname</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" name="lastname" type="text">
                    <label for="lastname">Lastname</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">face</i>
                    <input id="username" name="username" type="text">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="pass" name="password" type="password">
                    <label for="pass">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="pass2" name="password2" type="password">
                    <label for="pass2">Rewrite your Password</label>
                </div>
            </div>
            <div class="row center">
                <a class="btn waves-effect waves-light" id="signUp">Sign Up</a>
            </div>
            <div class="row">
                <a href="login" class="right">Already have an account ?</a>
                <a href="forgotPass" class="left">Forgot your password ?</a>
            </div>
        </form>
    </div>
</body>
</html>