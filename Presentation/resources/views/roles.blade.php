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
                        <th>Ime učešća</th>
                        <th>Boja učešća</th>
                        <th>Dozvole</th>
                        <th>Izmeni</th>
                        <th>Obriši</th>
                    </tr>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td style="background-color: {{$role->color}}">{{$role->color}}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    @if($loop != $loop->last)
                                        {{$permission->name.', '}}
                                    @endif
                                    @if($loop == $loop->last)
                                        {{$permission->name."."}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($loop == $loop->first)
                                    <i style="color: black" class="fas fa-edit"></i>
                                @else
                                    <a href="{{route('editroles', $role->id)}}"><i style="color: black" class="fas fa-edit"></i></a>
                                @endif
                            </td>
                            <td><i onclick="{{($loop == $loop->first)? '' : "document.getElementById('deleteRole".$loop->index."').submit();"}}" class="fas fa-user-minus"></i></td>
                            <form id="{{($loop == $loop->first)? '' : 'deleteRole'.$loop->index}}" action="{{route('destroyroles')}}" method="POST" style="display: none">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$role->id}}">
                            </form>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
        <section>
            <div class="tittle-section">
                dodaj učešće
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
                    <label>Naziv učešća</label>
                    <input type="text" class="form-control @error('rolename') is-invalid @enderror" name="rolename" value="{{ old('rolename') }}" required autocomplete="name" autofocus>
                    @error('rolename')
                    <span class="invalid-feedback" role="alert">
                        <strong>Naziv učešća {{ $message }}</strong>
                    </span>
                    @enderror
                    <label>Boja učešća</label><br>
                    <input type="color" name="rolecolor"/><br>
                    <label>Dozvole učešća</label><br>
                    @foreach($permissions as $per)
                        <input type="checkbox" name="permission{{$loop->index}}" value="{{$per->id}}">{{$per->name}} <br>
                    @endforeach
                    <button type="submit">
                        Pošalji
                    </button>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
