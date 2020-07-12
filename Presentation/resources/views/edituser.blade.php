
@extends('layouts.main')
@section('tittle', 'Izmena korisnika | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        @if(Permission::Check('users.edit'))
            <section>
                <div class="tittle-section">
                    Izmena korisnika: {{$user->username}}
                </div>

                <div class="content-section">
                    @if($message = session('updated'))
                        <div class="true-message">
                            <p>{{$message}}</p>
                        </div>
                    @endif

                    @if($message = session('error'))
                        <div class="false-message">
                            <p>{{$message}}</p>
                        </div>
                    @endif
                    <form action="{{route('updateusers')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <img class="image-avatar" src="/images/avatars/{{$user->avatar_path}}" alt="Korisnik nema avatar!">
                        <input type="file" name="avatar"><br>
                        <input type="hidden" name="lastavatar" value="{{$user->avatar_path}}">
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                                <strong>Avatar {{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" name="id" value="{{$user->id}}" required>
                        <label>Korisnicko ime</label>
                        <input type="text" name="username" value="{{$user->username}}" required>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>Korisničko ime {{ $message }}</strong>
                            </span>
                        @enderror
                        <label>E-pošta korisnika</label>
                        <input type="email" name="email" value="{{$user->email}}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>E-pošta {{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Ime korisnika</label>
                        <input type="text" name="name" value="{{$user->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>Ime korisnika {{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Prezime korisnika</label>
                        <input type="text" name="lastname" value="{{$user->lastname}}">
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                                <strong>Prezime korisnika {{ $message }}</strong>
                            </span>
                        @enderror

                        <label>Lozinka</label>
                        <input type="password" name="password" >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>Lozinka {{ $message }}</strong>
                            </span>
                        @enderror
                        <label>Potvrda lozinke</label>
                        <input type="password" name="password_confirmation" >

                        <label>Učešće korisnika</label>
                        <select name="role" required>
                            @foreach($roles as $role)
                                @if($role->id == $user->role->id)
                                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                                <strong>Učešće korisnika {{ $message }}</strong>
                            </span>
                        @enderror
                        <button>
                            Sačuvaj
                        </button>
                    </form>
                </div>
            </section>
        @endif
    </div>
    @include('adminsidebar')
@endsection
