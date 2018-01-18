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
    <title>Mini Tweet</title>
</head>
<body>
    <div class="container">
        <div class="row center">
            <h1>Welcome to Todo List !!</h1>
            <h2>Please write the requested information to reset your password</h1>
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
            <div class="row center">
                <a class="btn waves-effect waves-light">Get a new Password</a>
            </div>
            <div class="row">
                <a href="register" class="right">Don't have an account ?</a>
                <a href="login" class="left">You know you username and password ?</a>
            </div>
        </form>
    </div>
</body>
</html>