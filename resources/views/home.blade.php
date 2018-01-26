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
    <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>
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
    <div class="side-nav fixed">
        <form id="formUserSearch" action="{{ url('/searchUser') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input name="userSearch" type="text" placeholder="Search User">
                </div>
                <div class="row center">
                    <button class="btn waves-effect waves-light" id="userSearch" type="submit">Search User<i class="material-icons right">search</i></button>
                </div>
            </div>
		</form>
        <div class="row center card-panel">
            <form action="{{ url('/logout') }}" method="POST">
                {{ csrf_field() }}
                <button class="waves-effect btn-flat" type="submit">Logout</button>
            </form>
        </div>
        <div class="row center card-panel">
            <p>{{ $user['firstname'] }} <i id="editFirstname" class="material-icons editIcon">mode_edit</i></p>
            <p>{{ $user['lastname'] }} <i id="editLastname" class="material-icons editIcon">mode_edit</i></p>
            <p>{{ '@' . $user['login'] }}</p>
        </div>
        <div class="row card-panel">
            <form action="{{ url('/changePassword') }}" method="POST">
                {{ csrf_field() }}
                <button class="waves-effect btn-flat" type="submit">Change Your Password</button>
            </form>
        </div>
        <div class="row center card-panel">
            <p>Account created at {{ $user['createdDate'] }}</p>
        </div>
        <div class="row center card-panel">
            <p>Display form tweet</p>
            <i class="medium material-icons" id="visibilityFormTweet">visibility</i>
        </div>
        <div class="row card-panel danger-zone">
            <form action="{{ url('/deleteAccount') }}" method="POST">
                {{ csrf_field() }}
			    <button class="waves-effect btn-flat" type="submit">Remove This Account</button>
            </form>
		</div>
    </div>
    <div class="container" id="body">
        <div class="container" id="userTweet">
            @if(!$tweets->isEmpty())
                @foreach($tweets as $tweet)
                    <div class="container tweet">
                        <div class="col s12 m6">
                            <div class="card">
                                <form class="formDeleteTweet" action="{{ $tweet->deleteUrl }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="waves-effect btn-flat"><i class="material-icons">delete</i></button>
                                </form>
                                <div class="card-content">
                                    <span class="card-title">{{ $user['firstname']}} {{ $user['lastname'] }}  {{ '@' . $user['login'] }}</span>
                                    <p class="tweetContent">{{ $tweet->content }}</p>
                                </div>
                                <div class="card-action">
                                    <span class="tweetDate">Tweet send at {{ $tweet->created_at }}</span>
                                    <form class="formLoveTweet" action="{{ $tweet->loveUrl }}" method="POST">
                                        {{ csrf_field() }}
                                        @if(!$tweet->favorite)
                                            <button class="waves-effect btn-flat"><i class="material-icons">favorite_border</i></button>
                                        @else
                                            <button class="waves-effect btn-flat"><i class="material-icons">favorite</i></button>
                                        @endif
                                    </form>
                                    <form class="formFavoriteTweet" action="{{ $tweet->favoriteUrl }}" method="POST">
                                        {{ csrf_field() }}
                                        @if(!$tweet->love)
                                            <button class="waves-effect btn-flat"><i class="material-icons">star_border</i></button>
                                        @else
                                            <button class="waves-effect btn-flat"><i class="material-icons">star</i></button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            @endif
        </div>
        <div class="container">
            {{ $tweets->links() }}
        </div>
        <div id="divFormTweet" class="container">
            <form action="{{ url('/sendTweet') }}" method="POST" id="formTweet" class="container input-field col s12">
                {{ csrf_field() }}
				<i class="material-icons prefix">message</i>
				<textarea id="textareaTweet" name="textareaTweet" class="materialize-textarea" maxlength="120"></textarea>
				<label for="textareaTweet">Tweet</label>
                <div class="row center">
                    <button class="waves-effect btn-flat" id="sendTweet">Send the tweet<i class="material-icons right">send</i></button>
                </div>
            </form>
		</div>
    </div>
</body>
</html>