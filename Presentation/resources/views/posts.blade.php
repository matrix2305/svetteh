@extends('layouts.main')
@section('tittle', 'Učešća | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Korisnici
            </div>

            <div class="content-section">
                @if($message = session('deleted'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <table>
                    <tr>
                        <th>Naziv objave</th>
                        <th>Tekst</th>
                        <th>Kategorije</th>
                        <th>Autor</th>
                        <th>Vreme objavljivanja</th>
                        <th>Vreme poslednje izmene</th>
                        <th>Izmeni</th>
                        <th>Obriši</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{substr($post->text, 0, 30)}}</td>
                            <td>
                                @foreach($post->categories as $category)
                                    @if(count($post->categories) == 1)
                                        {{$category->name}}
                                    @else
                                        @if($loop != $loop->last)
                                            {{$category->name.', '}}
                                        @endif
                                        @if($loop == $loop->last)
                                            {{$category->name."."}}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$post->name.' '.$post->lastname}}</td>
                            <td>{{$post->createdAt}}</td>
                            <td>{{$post->updatedAt}}</td>
                            <td><a href=""><i style="color: black" class="fas fa-edit"></i></a></td>
                            <td><i onclick="document.getElementById('deletePost{{$loop->index}}').submit();" class="fas fa-user-minus"></i></td>
                            <form id="deletePost{{$loop->index}}" action="{{route('destroyposts')}}" method="POST" style="display: none">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$post->id}}">
                            </form>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
