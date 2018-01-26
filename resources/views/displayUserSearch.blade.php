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
    <div class="container" id="body">
        @if(!$users->isEmpty())
            @foreach($users as $user)
                <div class="container center">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">{{ $user->firstname }} {{ $user->lastname }}</span>
                                <p><a href="user/{{ $user->login }}">{{ '@' . $user->login }}</a></p>
                                <p>Email : {{ $user->email }}</p>
                                <p>Ceated at {{ $user->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">No users who have '{{ $userSearch }}' in there username !!</span>
                            <p class="tweetContent"><a href="home">Click here to go back to your home page !!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="container">
        {{ $users->links() }}
    </div>
</body>
</html>