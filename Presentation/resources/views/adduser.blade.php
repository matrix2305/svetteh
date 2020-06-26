@extends('layouts.main')

@section('content')
   <div class="main">
       <div class="tittle-page">
           Admin panel
       </div>
       <section>
           <div class="tittle-section">
               dodaj korisnika
           </div>
           <div class="content-section">
               @if($message = session('error'))
                   <div class="false-message">
                       <p>{{$message}}</p>
                   </div>
               @endif
               @if($message = session('success'))
                   <div class="true-message">
                       <p>{{$message}}</p>
                   </div>
               @endif
               <form  method="POST" action="{{ route('storeuser') }}">
                   @csrf
                   @method('put')
                   <label>Korisničko ime</label>
                   <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>
                   @error('username')
                   <span class="invalid-feedback" role="alert">
                        <strong>Korisničko ime {{ $message }}</strong>
                    </span>
                   @enderror
                   <label>E-pošta</label>
                   <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                   @error('email')
                   <span class="invalid-feedback" role="alert">
                        <strong>E-pošta {{ $message }}</strong>
                    </span>
                   @enderror
                   <label>Lozinka</label>
                   <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                   @error('password')
                   <span class="invalid-feedback">
                        <strong>Lozinka {{ $message }}</strong>
                   </span>
                   @enderror
                   <label>Potvrdi lozinku</label>
                   <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                   <button type="submit">
                       Registruj se
                   </button>
               </form>
        </div>
       </section>
   </div>
   @include('adminsidebar')
@endsection
