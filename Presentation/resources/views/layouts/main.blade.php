<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('tittle') | Svet tehnologija</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dd9d49e9ef.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
<div class="wrapper">
    <header>
        <div class="hcontent">
            <div class="logo">
                <img src="/img/logo.png">
            </div>
            <div class="navbar">
                <ul>
                    <li id="{{(request()->path() == '/')? 'active':''}}"><a href="/">Početna</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li id="{{($path = explode('/',request()->path())[0] == 'dashboard')? 'active':''}}"><a href="{{ url('/dashboard') }}">Panel</a></li>
                            <li onclick="document.getElementById('logout-form').submit();"><a>Odjavi se</a></li>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
                                @csrf
                            </form>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>

                @if(request()->path() == '' or request()->path() == '/')
                    <div class="social-icons">
                        @if($content->facebook != null)
                            <a href="{{$content->facebook}}"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($content->instagram != null)
                            <a href="{{$content->instagram}}"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>
    <footer class="footer">
        <p>All rights reserved by Srdjan Radosavljevic 2020 &copy;</p>
    </footer>
</div>

</body>
</html>
