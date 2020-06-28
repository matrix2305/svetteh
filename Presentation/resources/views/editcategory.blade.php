
@extends('layouts.main')
@section('tittle', 'Izmena kategorije | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Izmena kategorije: {{$category->name}}
            </div>

            <div class="content-section">
                @if($message = session('error'))
                    <div class="false-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <form action="{{route('updatecategory')}}" method="POST">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <label>Ime kategorije</label>
                    <input type="text" name="name" value="{{$category->name}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>Ime korisnika {{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Boja kategorije</label>
                    <input type="color" name="color" value="{{$category->color}}">
                    <button>
                        Pošalji
                    </button>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
