@extends('layouts.login')

@section('tittle', 'Prijavi se')
@section('content')
<div class="container">
    <div class="form-login">
        <img src="img/logo.png" alt="Portal logo">
        <h3>Prijavi se</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if($message = session('error'))
                <span role="alert" style="background: red;">
                    <strong>{{ $message }}</strong>
                </span>
            @endif

            <div>
                <label class="labelitem">E-pošta ili korisničko ime</label>

                <div>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="username" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="item">
                <label class="labelitem">Lozinka</label>
                <div>
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="item">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label for="remember">
                    Remember me
                </label>
            </div>
             <div class="item">
                 <button type="submit">
                     {{ __('Login') }}
                 </button>
             </div>
                    @if (Route::has('password.request'))
                        <a class="forgotpassword" href="{{ route('password.request') }}">
                            {{ __('Zaboravili ste lozinku?') }}
                        </a>
                    @endif
        </form>
    </div>
</div>
@endsection
