@extends('layouts.main')
@section('tittle', 'Učešća | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Učešća
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
                        @if(Permission::Check('roles.edit'))
                            <th>Izmeni</th>
                        @endif
                        @if(Permission::Check('roles.delete'))
                            <th>Obriši</th>
                        @endif
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
                            @if(Permission::Check('roles.edit'))
                                <td>
                                    @if($loop == $loop->first)
                                        <i style="color: black" class="fas fa-edit"></i>
                                    @else
                                        <a href="{{route('editroles', $role->id)}}"><i style="color: black" class="fas fa-edit"></i></a>
                                    @endif
                                </td>
                            @endif
                            @if(Permission::Check('roles.delete'))
                                <td><i onclick="{{($loop == $loop->first)? '' : "document.getElementById('deleteRole".$loop->index."').submit();"}}" class="fas fa-trash"></i></td>
                                <form id="{{($loop == $loop->first)? '' : 'deleteRole'.$loop->index}}" action="{{route('destroyroles')}}" method="POST" style="display: none">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$role->id}}">
                                </form>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>
        @if(Permission::Check('roles.create'))
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
                        <input type="text" name="rolename" value="{{ old('rolename') }}" required autocomplete="name" autofocus>
                        @error('rolename')
                        <span class="invalid-feedback" role="alert">
                            <strong>Naziv učešća {{ $message }}</strong>
                        </span>
                        @enderror
                        <label>Boja učešća</label><br>
                        <input type="color" name="rolecolor"/><br>
                        @error('rolecolor')
                        <span class="invalid-feedback" role="alert">
                            <strong>Naziv učešća {{ $message }}</strong>
                        </span>
                        @enderror
                        <label>Dozvole učešća</label><br>
                        @foreach($permissions as $per)
                            <input type="checkbox" name="permission[]" value="{{$per->id}}">{{$per->name}} <br>
                        @endforeach
                        <button type="submit">
                            Pošalji
                        </button>
                    </form>
                </div>
            </section>
        @endif
    </div>
    @include('adminsidebar')
@endsection
