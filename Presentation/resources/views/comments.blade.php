@extends('layouts.main')
@section('tittle', 'Komentari | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Aktivni komentari
            </div>

            <div class="content-section">
                @if($message = session('success'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                @if($message = session('error'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <table>
                    <tr>
                        <th>Ime</th>
                        <th>E-pošta</th>
                        <th>Tekst</th>
                        <th>Objava</th>
                        <th>Vreme komentarisanja</th>
                        @if(Permission::Check('comments.allow'))
                            <th>Dozvoli</th>
                        @endif
                        @if(Permission::Check('comments.delete'))
                            <th>Obrisi</th>
                        @endif
                    </tr>
                    @foreach($comments as $comment)
                        @if($comment->allowed == 1)
                            <tr>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->email}}</td>
                                <td>{{$comment->text}}</td>
                                <td>{{$comment->posttitle}}</td>
                                <td>{{$comment->createdAt}}</td>
                                @if(Permission::Check('comments.allow'))
                                    <td><i onclick="document.getElementById('allowComment{{$loop->index}}').submit();" class="fas fa-check"></i></td>
                                    <form id="allowComment{{$loop->index}}" method="POST" action="{{route('allowcomment')}}" style="display: none">
                                        @csrf
                                        <input type="hidden" value="{{$comment->id}}">
                                    </form>
                                @endif
                                @if(Permission::Check('comments.delete'))
                                    <td><i onclick="document.getElementById('deleteComment{{$loop->index}}').submit();" class="fas fa-trash"></i></td>
                                    <form id="deleteComment{{$loop->index}}" method="POST" action="{{route('deletecomment')}}" style="display: none">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" value="{{$comment->id}}">
                                    </form>
                                @endif
                            </tr>

                        @endif
                    @endforeach
                </table>
            </div>
        </section>
        <section>
            <div class="tittle-section">
                Nekativni komentari
            </div>

            <div class="content-section">
                @if($message = session('success'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                @if($message = session('error'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <table>
                    <tr>
                        <th>Ime</th>
                        <th>E-pošta</th>
                        <th>Tekst</th>
                        <th>Objava</th>
                        <th>Vreme komentarisanja</th>
                        @if(Permission::Check('comments.delete'))
                            <th>Obrisi</th>
                        @endif
                    </tr>
                    @foreach($comments as $comment)
                        @if($comment->allowed == 0)
                            <tr>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->email}}</td>
                                <td>{{$comment->text}}</td>
                                <td>{{$comment->posttitle}}</td>
                                <td>{{$comment->createdAt}}</td>
                                @if(Permission::Check('comments.delete'))
                                    <td><i onclick="document.getElementById('deleteComment{{$loop->index}}').submit();" class="fas fa-trash"></i></td>
                                    <form id="deleteComment{{$loop->index}}" method="POST" action="{{route('deletecomment')}}" style="display: none">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" value="{{$comment->id}}">
                                    </form>
                                @endif
                            </tr>

                        @endif
                    @endforeach
                </table>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
