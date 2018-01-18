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
    <script type="text/javascript" src="{{ URL::asset('js/login.js') }}"></script>
    <title>Mini Tweet</title>
</head>
<body>
    <div class="container">
        <div class="row">
            @if(Session::has('message'))
                <p class="toast rounded {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row center">
            <h1>Welcome to My Mini Tweet !!</h1>
            <h2>Please log in to begin</h2>
        </div>
    </div>
    <div class="container">
        <form id="loginForm" action="{{ url('/login') }}" method="POST" class="row">
            {{ csrf_field() }}
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
                    <label for="pass">Mot de passe</label>
                </div>
            </div>
            <div class="row center">
                <button class="btn waves-effect waves-light" id="login" type="submit">Login</button>
            </div>
            <div class="row">
                <a href="register" class="right">Don't have an account ?</a>
                <a href="forgotPass" class="left">Forgot your password ?</a>
            </div>
        </form>
    </div>
</body>
</html>