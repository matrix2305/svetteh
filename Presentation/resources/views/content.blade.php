@extends('layouts.main')
@section('tittle', 'Sadržaj | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                sadržaj
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
                <form action="{{route('updatecontent')}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="item-label">
                        <label>Naziv:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="name" value="{{$content->name}}" required>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>Ime {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-label">
                        <label>Naziv:</label>
                    </div>
                    <textarea name="text" required>
                        {{$content->text}}
                    </textarea>

                    @error('text')
                    <span class="invalid-feedback" role="alert">
                        <strong>Tekst {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-label">
                        <label>Adresa:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="adress" value="{{$content->adress}}">
                    </div>
                    @error('adress')
                    <span class="invalid-feedback" role="alert">
                        <strong>Tekst {{ $message }}</strong>
                    </span>
                    @enderror


                    <div class="item-label">
                        <label>Telefon:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="phone" value="{{$content->phone}}">
                    </div>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>Telefon {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-label">
                        <label>E-pošta:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="email" value="{{$content->email}}" required>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>E-pošta {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-label">
                        <label>Instagram URL:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="instagram" value="{{$content->instagram}}">
                    </div>
                    @error('instagram')
                    <span class="invalid-feedback" role="alert">
                        <strong>Instagram {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-label">
                        <label>Facebook URL:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="facebook" value="{{$content->facebook}}">
                    </div>
                    @error('facebook')
                    <span class="invalid-feedback" role="alert">
                        <strong>Facebook {{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="item-input">
                        <button>Pošalji</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
