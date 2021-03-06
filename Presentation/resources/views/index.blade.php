@section('tittle', 'Početna')

@extends('layouts.main')

@section('content')
    <main class="main">
        @if(!empty($posts) and count($posts)>3)
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
                @if(count($posts)>3)
                    @if($loop->index > 3)
                        <div class="posts-list">
                            <img src="/images/posts/{{$post->image_path}}">
                            <h1>{{$post->title}}</h1>
                            <p>{{substr($post->text, 0, 250)}}...</p>
                        </div>
                    @endif
                @else
                    <div class="posts-list">
                        <img src="/images/posts/{{$post->image_path}}">
                        <h1>{{$post->title}}</h1>
                        <p>{{substr($post->text, 0, 250)}}...</p>
                    </div>
                @endif
            @endforeach

    </main>
    @include('portalsidebar')
    @include('contactpart')
@endsection

