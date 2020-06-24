@extends('layouts.login')

@section('content')
<div class="container">
    <div class="form-login">
        <img src="/img/logo.png" alt="Portal logo">
        <h3>Resetovanje lozinke</h3>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="labelitem">E-pošta</label>

                <div class="item">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="item">
                <button type="submit" class="btn btn-primary">
                    Pošalji
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
