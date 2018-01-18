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
        <div class="row">
            @if(Session::has('message'))
                <p class="toast rounded {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row center">
            <h1>Welcome to My Mini Tweet {{ $firstname }} {{ $lastname }} !!</h1>
        </div>
    </div>
    <div class="container">
        <form action="{{ url('/logout') }}" method="POST" class="row">
            {{ csrf_field() }}
            <button class="btn waves-effect waves-light" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>