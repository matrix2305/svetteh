@section('tittle', 'Početna')

@extends('layouts.main')

@section('content')
    <main class="main">
        @if(!empty($posts))
            <div class="posts-grid">
                @for($i = 0; $i<3; $i++)
                    @if($i == 0)
                        <div class="post0" style="background-image: url({{'/images/posts/'.$posts[$i]->image_path}});">
                            <div class="background-color float-right">
                                <h3>{{$posts[$i]->title}}</h3>
                                <p>{{$posts[$i]->text}}</p>
                            </div>

                        </div>
                    @endif
                    @if($i>0)
                        <div class="post{{$i}}" style="background-image: url({{'/images/posts/'.$posts[$i]->image_path}});">
                            <div class="background-color">
                                <h3>{{$posts[$i]->title}}</h3>
                                <p>{{$posts[$i]->text}}</p>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        @endif
            @foreach($posts as $post)
                @if($loop->index > 3)
                    <div class="posts-list">
                        <h1>{{$post->title}}</h1>
                        <p>{{$post->text}}</p>
                    </div>
                @endif
            @endforeach

    </main>
    @include('portalsidebar')
    @include('contactpart')
@endsection

