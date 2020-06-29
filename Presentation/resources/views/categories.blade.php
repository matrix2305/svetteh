@extends('layouts.main')
@section('tittle', 'Kategorije | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Kategorije
            </div>

            <div class="content-section">
                @if($message = session('updated'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                @if($message = session('deleted'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <table>
                    <tr>
                        <th>Ime kategorije</th>
                        <th>Boja kategorije</th>
                        @if(Permission::Check('category.edit'))
                            <th>Izmeni</th>
                        @endif
                        @if(Permission::Check('category.delete'))
                            <th>Obriši</th>
                        @endif
                    </tr>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td style="background-color: {{$category->color}}">{{$category->color}}</td>
                            @if(Permission::Check('category.edit'))
                                <td><a href="{{route('editcategory', $category->id)}}"><i style="color: black" class="fas fa-edit"></i></a></td>
                            @endif
                            @if(Permission::Check('category.delete'))
                                <td><i onclick="document.getElementById('deleteCategory{{$loop->index}}').submit();" class="fas fa-trash"></i></td>

                                <form id="deleteCategory{{$loop->index}}" action="{{route('destroycategory')}}" method="POST" style="display: none">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                </form>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
        @if(Permission::Check('category.create'))
            <section>
                <div class="tittle-section">
                    dodaj kategoriju
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
                    <form action="{{route('storecategory')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="item-label">
                            <label>Ime kategorije:</label>
                        </div>
                        <div class="item-input">
                            <input type="text" name="category_name">
                        </div>
                        @error('category_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>Ime korisnika {{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="item-label">
                            <label>Boja kategorije:</label>
                        </div>
                        <div class="item-input">
                            <input type="color" name="category_color"/>
                        </div>
                        <div class="item-input">
                            <button>Pošalji</button>
                        </div>
                    </form>
                </div>
            </section>
        @endif
    </div>
    @include('adminsidebar')
@endsection
