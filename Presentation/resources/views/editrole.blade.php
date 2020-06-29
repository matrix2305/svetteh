@extends('layouts.main')
@section('tittle', 'Izmena učešće | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        @if(Permission::Check('roles.edit'))
            <section>
                <div class="tittle-section">
                    Izmena učešće: {{$role->name}}
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
                   <form action="{{route('updateroles')}}" method="POST">
                       @csrf
                       @method('patch')
                       <input type="hidden" name="id" value="{{$role->id}}">
                       <label>Ime učešća</label>
                       <input type="text" name="name" value="{{$role->name}}">
                       <label>Boja učešća</label>
                       <input type="color" name="color" value="{{$role->color}}">
                       <label>Dozvole učešća</label>
                       @foreach($permissions as $permission)
                           @foreach($role->permissions as $check)
                               @if($check->id == $permission->id)
                                   <input type="checkbox" name="permission[]" value="{{$permission->id}}" checked> {{$permission->name}} <br>
                                   @break
                               @endif
                               @if($loop == $loop->last)
                                       <input type="checkbox" name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                               @endif
                           @endforeach
                       @endforeach
                       <button>
                           Pošalji
                       </button>
                   </form>
                </div>
            </section>
        @endif
    </div>
    @include('adminsidebar')
@endsection
