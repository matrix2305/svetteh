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
            @if (session('status'))
                <div class="user-info" role="alert">
                    <p>Dobrodošao korisniče {{ session('status') }}</p>
                </div>
            @endif
            <div class="navbar">
                <ul>
                    <li><a id="{{(request()->path() == '/')? 'active':''}}" href="/">Početna</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a id="{{($path = explode('/',request()->path())[0] == 'dashboard')? 'active':''}}" href="{{ url('/dashboard') }}">Panel</a></li>
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
