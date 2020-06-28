@extends('layouts.main')
@section('tittle', 'Izmena objave | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Izmena objave:
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
                <form action="{{route('updateposts')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <img class="image-post" src="/images/posts/{{$post->image_path}}" alt="Post image">
                    <input type="file" name="image"> <br>
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <input type="hidden" name="lastimage" value="{{$post->image_path}}">
                    <label>Naziv objave</label>
                    <input type="text" name="title" value="{{$post->title}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>Naziv {{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Tekst objave</label>
                    <textarea name="text">{{$post->text}}</textarea>
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                            <strong>Avatar {{ $message }}</strong>
                        </span>
                    @enderror
                    <label>Kategorije objave</label> <br>
                    @foreach($categories as $category)
                        @foreach($post->categories as $postcat)
                            @if($postcat->id == $category->id)
                                <input type="checkbox" value="{{$category->id}}" name="categories[]" checked> {{$category->name}} <br>
                                @break
                            @endif
                            @if($loop == $loop->last)
                                    <input type="checkbox" value="{{$category->id}}" name="categories[]"> {{$category->name}} <br>
                            @endif
                        @endforeach
                    @endforeach
                    @error('categories')
                    <span class="invalid-feedback" role="alert">
                            <strong>Kategorije {{ $message }}</strong>
                        </span>
                    @enderror

                    <button>
                        Pošalji
                    </button>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
