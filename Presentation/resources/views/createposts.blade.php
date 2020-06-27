@extends('layouts.main')
@section('tittle', 'Dodaj objavu | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                dodaj objavu
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
                <form  method="POST" action="{{ route('storeroles') }}">
                    @csrf
                    @method('put')
                    <label>Naziv objave</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>Naziv {{ $message }}</strong>
                    </span>
                    @enderror
                    <label>Tekst objave</label><br>
                    <textarea name="text"></textarea><br>
                    <label>Kategorije objave</label><br>
                    @foreach($categories as $category)
                        <input type="checkbox" name="category{{$loop->index}}" value="{{$category->id}}">{{$category->name}} <br>
                    @endforeach
                    <label>Slika objave</label><br>
                    <input type="file" id="postimage" name="image"><br>
                    <button type="submit">
                        Pošalji
                    </button>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
